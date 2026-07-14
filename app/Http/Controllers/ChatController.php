<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    private string $systemPrompt = <<<PROMPT
You are an AI assistant on Cihan Ören's personal portfolio website. You represent Cihan professionally.

## About Cihan Ören
- Computer Engineering graduate of Artvin Çoruh University, Turkey
- Lead Mobile Developer at EduChamp — a live, multi-role (7 roles) school management platform built with Flutter
- Flutter specialist: Clean Architecture, GetX, REST APIs, Firebase
- Also builds with Laravel, PHP, ASP.NET Core, and does LLM/AI integration work
- 3 published apps: Story Map (App Store & Google Play), Tale Maker (Google Play), EduChamp
- Graduation projects: TruvaLens (AI deepfake detection app), YolcuSayar (real-time passenger counter with YOLOv5 + DeepSORT), GreenLog (botanical garden inventory system)
- Placed 6th at Teknofest 2024 in the Disaster Management category
- Also does freelance Flutter development on Upwork and Freelancer.com
- Available for freelance mobile development projects
- Based in Turkey
- Contact: cihan@cihanoren.com | github.com/cihanoren | linkedin.com/in/cihanoren

## How to behave
- Be warm, natural and conversational — not robotic or corporate
- Keep responses SHORT: 2-3 sentences max. Never write walls of text.
- NEVER repeat yourself. If you already asked for email, don't ask again.
- NEVER ask for email more than once per conversation.
- If visitor already gave their email, acknowledge it and move on: "Teşekkürler, notunu aldım!"
- Stay on topic: Cihan's work, skills, projects, and potential collaboration
- If asked something unrelated, gently redirect

## Language
- Detect language from first user message
- Turkish → reply Turkish throughout
- English → reply English throughout
- NEVER switch languages mid-conversation

## Email collection
- Ask for email ONLY ONCE, only when visitor clearly shows interest in working together
- After they give email: acknowledge warmly and confirm Cihan will reach out
- NEVER ask for email again after they've provided it

## Project analysis
When someone shares a project idea, briefly cover:
1. What tech Cihan would use (1 line)
2. Rough complexity (simple/medium/complex)
3. Whether Cihan can help (almost always yes for mobile apps)
PROMPT;

    public function chat(Request $request)
    {
        $request->validate([
            'message'      => ['required', 'string', 'max:1000'],
            'anonymous_id' => ['required', 'string', 'max:100'],
        ]);

        $session = ChatSession::firstOrCreate(
            ['anonymous_id' => $request->anonymous_id],
            [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'language'   => 'en',
            ]
        );

        $session->update(['last_active_at' => now()]);

        // Email tespit et
        $this->extractEmail($request->message, $session);

        // Kullanıcı mesajını kaydet
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'role'            => 'user',
            'content'         => $request->message,
        ]);

        // Tüm konuşma geçmişini al
        $history = $session->messages()
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'role'    => $m->role,
                'content' => $m->content,
            ])
            ->toArray();

        // Email varsa system prompt'a ekle
        $systemPrompt = $this->systemPrompt;
        if ($session->email) {
            $systemPrompt .= "\n\n## Important context\nVisitor already provided their email: {$session->email}. Do NOT ask for email again.";
        }

        try {
            $response = Http::withToken(env('OPENAI_API_KEY'))
                ->timeout(30)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model'       => 'gpt-4o-mini',
                    'max_tokens'  => 250,
                    'temperature' => 0.75,
                    'messages'    => array_merge(
                        [['role' => 'system', 'content' => $systemPrompt]],
                        $history
                    ),
                ]);

            if (!$response->successful()) {
                return response()->json(['error' => 'AI service unavailable'], 503);
            }

            $reply = $response->json('choices.0.message.content');

            ChatMessage::create([
                'chat_session_id' => $session->id,
                'role'            => 'assistant',
                'content'         => $reply,
            ]);

            // Her 3 mesajda bir analiz yap
            $messageCount = $session->messages()->count();
            if ($messageCount >= 3 && $messageCount % 3 === 0) {
                $this->analyzeSession($session);
            }

            return response()->json([
                'reply'      => $reply,
                'session_id' => $session->anonymous_id,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    private function analyzeSession(ChatSession $session): void
    {
        $conversation = $session->messages()
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => "{$m->role}: {$m->content}")
            ->implode("\n");

        $prompt = <<<ANALYSIS
Analyze this conversation from a portfolio website chatbot and return ONLY valid JSON, no explanation, no markdown.

Conversation:
{$conversation}

Return this exact JSON structure:
{
  "tags": ["tag1", "tag2", "tag3"],
  "project_idea": "one sentence summary of their project idea or null",
  "personality": "one of: technical/non-technical, patient/impatient, professional/casual",
  "lead_score": 7
}

Rules:
- tags: 2-5 short lowercase keywords about their interests (e.g. mobile-app, portfolio, e-commerce, flutter)
- project_idea: brief summary if they mentioned a project, otherwise null
- personality: pick the most fitting descriptors separated by comma
- lead_score: 0-10 integer (0=just browsing, 5=interested, 8=ready to hire, 10=gave email+clear project)
ANALYSIS;

        try {
            $response = Http::withToken(env('OPENAI_API_KEY'))
                ->timeout(20)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model'       => 'gpt-4o-mini',
                    'max_tokens'  => 200,
                    'temperature' => 0.1,
                    'messages'    => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]);

            if (!$response->successful()) return;

            $raw = $response->json('choices.0.message.content');
            $raw = preg_replace('/```json|```/', '', $raw);
            $data = json_decode(trim($raw), true);

            if (!$data) return;

            $session->update([
                'tags'         => $data['tags'] ?? null,
                'project_idea' => $data['project_idea'] ?? null,
                'personality'  => $data['personality'] ?? null,
                'lead_score'   => isset($data['lead_score']) ? (int) $data['lead_score'] : 0,
            ]);

        } catch (\Exception $e) {
            // Analiz başarısız olsa da konuşma devam etmeli
        }
    }

    private function extractEmail(string $message, ChatSession $session): void
    {
        if ($session->email) return;

        preg_match('/[\w.+-]+@[\w-]+\.[\w.]+/', $message, $matches);

        if (!empty($matches[0])) {
            $session->update(['email' => $matches[0]]);
        }
    }
}