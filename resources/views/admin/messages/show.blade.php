@extends('layouts.admin')

@section('title', 'Message from ' . $message->name)
@section('page-title', 'Message')

@section('content')

<div class="max-w-2xl">

    {{-- Back --}}
    <a href="{{ route('admin.messages.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-white transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
        </svg>
        Back to messages
    </a>

    {{-- Message card --}}
    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 mb-4">

        {{-- Header --}}
        <div class="flex items-start justify-between gap-4 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center text-indigo-400 text-lg font-black shrink-0">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-white font-bold">{{ $message->name }}</p>
                    <a href="mailto:{{ $message->email }}" class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors">
                        {{ $message->email }}
                    </a>
                </div>
            </div>
            <div class="text-right shrink-0">
                <p class="text-xs text-gray-500">{{ $message->created_at->format('d M Y, H:i') }}</p>
                <p class="text-xs text-gray-600 mt-0.5">{{ $message->created_at->diffForHumans() }}</p>
            </div>
        </div>

        {{-- Message body --}}
        <div class="bg-white/[0.02] border border-white/[0.06] rounded-xl p-5">
            <p class="text-gray-300 text-sm leading-relaxed whitespace-pre-wrap">{{ $message->message }}</p>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-wrap items-center gap-2 mb-6">
        {{-- Read/Unread toggle --}}
        @if($message->is_read)
            <form method="POST" action="{{ route('admin.messages.unread', $message) }}">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-gray-400 hover:text-white text-xs font-medium transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/>
                    </svg>
                    Mark as unread
                </button>
            </form>
        @else
            <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-gray-400 hover:text-white text-xs font-medium transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Mark as read
                </button>
            </form>
        @endif

        {{-- Archive/Unarchive --}}
        @if($message->is_archived)
            <form method="POST" action="{{ route('admin.messages.unarchive', $message) }}">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-gray-400 hover:text-white text-xs font-medium transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                    </svg>
                    Move to inbox
                </button>
            </form>
        @else
            <form method="POST" action="{{ route('admin.messages.archive', $message) }}">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-gray-400 hover:text-white text-xs font-medium transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    Archive
                </button>
            </form>
        @endif

        {{-- Delete --}}
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
              onsubmit="return confirm('Delete this message?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/[0.08] border border-red-500/20 text-red-400 hover:bg-red-500/20 text-xs font-medium transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete
            </button>
        </form>
    </div>

    {{-- Reply form --}}
    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6">
        <h2 class="text-sm font-bold text-white mb-5">
            Reply to {{ $message->name }}
            <span class="text-gray-600 font-normal text-xs ml-1">→ {{ $message->email }}</span>
        </h2>

        @if(session('success'))
            <div class="mb-4 flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.messages.reply', $message) }}">
            @csrf
            <textarea name="reply" rows="6"
                      class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all resize-none mb-4"
                      placeholder="Write your reply...">{{ old('reply') }}</textarea>
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-600/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Send Reply
            </button>
        </form>
    </div>

</div>

@endsection