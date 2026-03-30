@extends('layouts.admin')

@section('title', 'Chat Session')
@section('page-title', 'Chat Session')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.chat.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
        </svg>
        Back to sessions
    </a>
</div>

<div class="grid md:grid-cols-[1fr_320px] gap-6">

    {{-- Conversation --}}
    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] overflow-hidden">
        <div class="px-6 py-4 border-b border-white/[0.06]">
            <p class="text-sm font-bold text-white">Conversation</p>
            <p class="text-xs text-gray-600 mt-0.5">{{ $messages->count() }} messages</p>
        </div>

        <div class="px-6 py-5 space-y-4 max-h-[600px] overflow-y-auto">
            @forelse($messages as $msg)
            <div class="flex gap-3 {{ $msg->role === 'user' ? 'justify-end' : '' }}">
                @if($msg->role === 'assistant')
                    <div class="w-7 h-7 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5"/>
                        </svg>
                    </div>
                @endif
                <div class="max-w-sm {{ $msg->role === 'user' ? 'bg-indigo-600' : 'bg-white/[0.05] border border-white/[0.06]' }} rounded-2xl {{ $msg->role === 'user' ? 'rounded-tr-sm' : 'rounded-tl-sm' }} px-4 py-3">
                    <p class="text-sm {{ $msg->role === 'user' ? 'text-white' : 'text-gray-300' }} leading-relaxed whitespace-pre-wrap">{{ $msg->content }}</p>
                    <p class="text-xs {{ $msg->role === 'user' ? 'text-indigo-300' : 'text-gray-600' }} mt-1.5">{{ $msg->created_at->format('H:i') }}</p>
                </div>
                @if($msg->role === 'user')
                    <div class="w-7 h-7 rounded-full bg-gray-700 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                @endif
            </div>
            @empty
                <p class="text-sm text-gray-600">No messages yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Session Info --}}
    <div class="space-y-4">

        {{-- Visitor --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-5">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-4">Visitor</p>
            <div class="space-y-3">
                <div>
                    <p class="text-xs text-gray-600 mb-0.5">Anonymous ID</p>
                    <p class="text-xs text-gray-400 font-mono break-all">{{ $chatSession->anonymous_id }}</p>
                </div>
                @if($chatSession->email)
                <div>
                    <p class="text-xs text-gray-600 mb-0.5">Email</p>
                    <a href="mailto:{{ $chatSession->email }}" class="text-sm text-indigo-400 hover:text-indigo-300">{{ $chatSession->email }}</a>
                </div>
                @endif
                @if($chatSession->name)
                <div>
                    <p class="text-xs text-gray-600 mb-0.5">Name</p>
                    <p class="text-sm text-white">{{ $chatSession->name }}</p>
                </div>
                @endif
                <div>
                    <p class="text-xs text-gray-600 mb-0.5">IP Address</p>
                    <p class="text-sm text-gray-400">{{ $chatSession->ip_address ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 mb-0.5">Last active</p>
                    <p class="text-sm text-gray-400">{{ $chatSession->last_active_at?->diffForHumans() ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 mb-0.5">First visit</p>
                    <p class="text-sm text-gray-400">{{ $chatSession->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- AI Analysis --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-5">
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-4">AI Analysis</p>
            <div class="space-y-3">

                {{-- Lead Score --}}
                <div>
                    <p class="text-xs text-gray-600 mb-1.5">Lead Score</p>
                    <div class="flex items-center gap-2">
                        <div class="flex-1 h-1.5 rounded-full bg-white/[0.06]">
                            <div class="h-full rounded-full {{ $chatSession->lead_score >= 7 ? 'bg-amber-400' : ($chatSession->lead_score >= 4 ? 'bg-indigo-400' : 'bg-gray-600') }}"
                                 style="width: {{ ($chatSession->lead_score / 10) * 100 }}%"></div>
                        </div>
                        <span class="text-xs font-bold {{ $chatSession->lead_score >= 7 ? 'text-amber-400' : ($chatSession->lead_score >= 4 ? 'text-indigo-400' : 'text-gray-500') }}">
                            {{ $chatSession->lead_score }}/10
                        </span>
                    </div>
                </div>

                {{-- Tags --}}
                @if($chatSession->tags && count($chatSession->tags) > 0)
                <div>
                    <p class="text-xs text-gray-600 mb-1.5">Interests & Tags</p>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($chatSession->tags as $tag)
                            <span class="text-xs px-2 py-0.5 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Project Idea --}}
                @if($chatSession->project_idea)
                <div>
                    <p class="text-xs text-gray-600 mb-1.5">Project Idea</p>
                    <p class="text-sm text-gray-300 leading-relaxed bg-white/[0.03] border border-white/[0.05] rounded-xl p-3">{{ $chatSession->project_idea }}</p>
                </div>
                @endif

                {{-- Personality --}}
                @if($chatSession->personality)
                <div>
                    <p class="text-xs text-gray-600 mb-1.5">Communication Style</p>
                    <p class="text-sm text-gray-400">{{ $chatSession->personality }}</p>
                </div>
                @endif

                @if(!$chatSession->tags && !$chatSession->project_idea && !$chatSession->personality)
                    <p class="text-xs text-gray-600">Analysis will appear after more messages.</p>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <form method="POST" action="{{ route('admin.chat.destroy', $chatSession) }}"
              onsubmit="return confirm('Delete this session and all messages?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-red-500/[0.08] border border-red-500/20 text-red-400 hover:bg-red-500/20 text-sm font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete session
            </button>
        </form>

    </div>
</div>

@endsection