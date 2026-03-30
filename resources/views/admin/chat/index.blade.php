@extends('layouts.admin')

@section('title', 'Chat Sessions')
@section('page-title', 'Chat Sessions')

@section('content')

@if($sessions->isEmpty())
    <div class="rounded-2xl border border-dashed border-white/[0.08] p-16 flex flex-col items-center justify-center gap-4 text-center">
        <div class="w-12 h-12 rounded-xl bg-white/[0.03] border border-white/[0.07] flex items-center justify-center">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
        </div>
        <div>
            <p class="text-white font-semibold mb-1">No chat sessions yet</p>
            <p class="text-sm text-gray-600">Conversations will appear here.</p>
        </div>
    </div>

@else
    <div class="mb-4 text-sm text-gray-500">{{ $sessions->count() }} session{{ $sessions->count() !== 1 ? 's' : '' }} total</div>

    <div class="rounded-2xl border border-white/[0.08] overflow-hidden">
        @foreach($sessions as $session)
        <a href="{{ route('admin.chat.show', $session) }}"
           class="flex items-center gap-5 px-6 py-4 border-b border-white/[0.04] last:border-0 hover:bg-white/[0.02] transition-colors">

            {{-- Avatar --}}
            <div class="w-10 h-10 rounded-full bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center shrink-0 text-indigo-400 text-sm font-bold">
                {{ strtoupper(substr($session->anonymous_id, 5, 1)) }}
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2.5 mb-0.5">
                    <p class="text-sm font-semibold text-white truncate">
                        {{ $session->email ?? $session->name ?? 'Anonymous visitor' }}
                    </p>
                    @if($session->email)
                        <span class="shrink-0 text-xs px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">Lead</span>
                    @endif
                    @if($session->lead_score >= 7)
                        <span class="shrink-0 text-xs px-2 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400">Hot</span>
                    @endif
                </div>
                <p class="text-xs text-gray-600 truncate">{{ $session->anonymous_id }}</p>
            </div>

            {{-- Tags --}}
            @if($session->tags)
                <div class="hidden md:flex items-center gap-1.5 flex-wrap max-w-xs">
                    @foreach(array_slice($session->tags, 0, 3) as $tag)
                        <span class="text-xs px-2 py-0.5 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif

            {{-- Stats --}}
            <div class="text-right shrink-0">
                <p class="text-xs text-gray-400">{{ $session->messages_count }} messages</p>
                <p class="text-xs text-gray-600 mt-0.5">
                    {{ $session->last_active_at ? $session->last_active_at->diffForHumans() : $session->created_at->diffForHumans() }}
                </p>
            </div>

            <svg class="w-4 h-4 text-gray-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @endforeach
    </div>
@endif

@endsection