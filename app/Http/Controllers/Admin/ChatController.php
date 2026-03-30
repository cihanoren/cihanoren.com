<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;

class ChatController extends Controller
{
    public function index()
    {
        $sessions = ChatSession::withCount('messages')
            ->orderByDesc('last_active_at')
            ->get();

        return view('admin.chat.index', compact('sessions'));
    }

    public function show(ChatSession $chatSession)
    {
        $messages = $chatSession->messages()->orderBy('created_at')->get();
        return view('admin.chat.show', compact('chatSession', 'messages'));
    }

    public function destroy(ChatSession $chatSession)
    {
        $chatSession->delete();
        return redirect()->route('admin.chat.index')->with('success', 'Session deleted.');
    }
}