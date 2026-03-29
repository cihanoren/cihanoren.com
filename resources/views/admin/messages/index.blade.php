@extends('layouts.admin')

@section('title', 'Messages')
@section('page-title', 'Messages')

@section('content')

{{-- Filter tabs --}}
<div class="flex items-center gap-1 mb-6 bg-white/[0.02] border border-white/[0.06] rounded-xl p-1 w-fit">
    <a href="{{ route('admin.messages.index', ['filter' => 'inbox']) }}"
       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $filter === 'inbox' ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:text-white' }}">
        Inbox
        @if($counts['inbox'] > 0)
            <span class="ml-1.5 text-xs {{ $filter === 'inbox' ? 'bg-white/20' : 'bg-white/[0.08]' }} px-1.5 py-0.5 rounded-full">{{ $counts['inbox'] }}</span>
        @endif
    </a>
    <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}"
       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $filter === 'unread' ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:text-white' }}">
        Unread
        @if($counts['unread'] > 0)
            <span class="ml-1.5 text-xs {{ $filter === 'unread' ? 'bg-white/20' : 'bg-violet-500/30 text-violet-300' }} px-1.5 py-0.5 rounded-full">{{ $counts['unread'] }}</span>
        @endif
    </a>
    <a href="{{ route('admin.messages.index', ['filter' => 'archived']) }}"
       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $filter === 'archived' ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:text-white' }}">
        Archived
        @if($counts['archived'] > 0)
            <span class="ml-1.5 text-xs {{ $filter === 'archived' ? 'bg-white/20' : 'bg-white/[0.08]' }} px-1.5 py-0.5 rounded-full">{{ $counts['archived'] }}</span>
        @endif
    </a>
</div>

@if($messages->isEmpty())
    <div class="rounded-2xl border border-dashed border-white/[0.08] p-16 flex flex-col items-center justify-center gap-4 text-center">
        <div class="w-12 h-12 rounded-xl bg-white/[0.03] border border-white/[0.07] flex items-center justify-center">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <div>
            <p class="text-white font-semibold mb-1">No messages</p>
            <p class="text-sm text-gray-600">
                {{ $filter === 'archived' ? 'No archived messages.' : 'No messages yet.' }}
            </p>
        </div>
    </div>

@else
    <div class="rounded-2xl border border-white/[0.08] overflow-hidden">
        @foreach($messages as $msg)
        <a href="{{ route('admin.messages.show', $msg) }}"
           class="flex items-start gap-4 px-6 py-4 border-b border-white/[0.04] last:border-0 hover:bg-white/[0.02] transition-colors {{ !$msg->is_read ? 'bg-indigo-500/[0.03]' : '' }}">

            {{-- Unread dot --}}
            <div class="mt-1.5 shrink-0">
                @if(!$msg->is_read)
                    <span class="w-2 h-2 rounded-full bg-indigo-400 block"></span>
                @else
                    <span class="w-2 h-2 rounded-full bg-transparent block"></span>
                @endif
            </div>

            {{-- Avatar --}}
            <div class="w-9 h-9 rounded-full bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center shrink-0 text-indigo-400 text-sm font-bold">
                {{ strtoupper(substr($msg->name, 0, 1)) }}
            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-4 mb-0.5">
                    <p class="text-sm font-semibold {{ !$msg->is_read ? 'text-white' : 'text-gray-300' }} truncate">
                        {{ $msg->name }}
                    </p>
                    <span class="text-xs text-gray-600 shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs text-gray-500 truncate">{{ $msg->email }}</p>
                <p class="text-xs text-gray-600 truncate mt-1">{{ Str::limit($msg->message, 80) }}</p>
            </div>

            {{-- Archived badge --}}
            @if($msg->is_archived)
                <span class="shrink-0 text-xs px-2 py-0.5 rounded-full bg-gray-500/10 border border-gray-500/20 text-gray-500">Archived</span>
            @endif
        </a>
        @endforeach
    </div>
@endif

@endsection