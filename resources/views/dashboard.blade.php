@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

@php
    $projectCount = \App\Models\Project::count();
    $publishedCount = \App\Models\Project::where('published', true)->count();
    $experienceCount = \App\Models\Experience::count();
@endphp

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    <a href="{{ route('admin.projects.index') }}" class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-5 hover:border-indigo-500/30 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Projects</p>
            <div class="w-8 h-8 rounded-lg bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center">
                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-black text-white">{{ $projectCount }}</p>
        <p class="text-xs text-gray-600 mt-1">{{ $publishedCount }} published</p>
    </a>

    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-5">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Messages</p>
            <div class="w-8 h-8 rounded-lg bg-violet-500/15 border border-violet-500/20 flex items-center justify-center">
                <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-black text-white">0</p>
        <p class="text-xs text-gray-600 mt-1">Unread messages</p>
    </div>

    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-5">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Experience</p>
            <div class="w-8 h-8 rounded-lg bg-emerald-500/15 border border-emerald-500/20 flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-black text-white">{{ $experienceCount }}</p>
    </div>

    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-5">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Security</p>
            <div class="w-8 h-8 rounded-lg bg-amber-500/15 border border-amber-500/20 flex items-center justify-center">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>
        <p class="text-sm font-black text-emerald-400">Active</p>
        <p class="text-xs text-gray-600 mt-1">2FA enabled</p>
    </div>

</div>

{{-- Quick actions --}}
<div class="grid md:grid-cols-2 gap-6 mb-8">

    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6">
        <h2 class="text-sm font-bold text-white mb-5">Quick Actions</h2>
        <div class="space-y-2">
            <a href="{{ route('admin.projects.create') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/[0.03] border border-white/[0.06] hover:border-indigo-500/40 hover:bg-indigo-500/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-indigo-500/15 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-400 group-hover:text-white transition-colors">Add new project</span>
            </a>

            <a href="{{ route('admin.messages.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/[0.03] border border-white/[0.06] hover:border-violet-500/40 hover:bg-violet-500/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-violet-500/15 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-400 group-hover:text-white transition-colors">View messages</span>
            </a>

            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/[0.03] border border-white/[0.06] hover:border-emerald-500/40 hover:bg-emerald-500/5 transition-all group">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/15 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-400 group-hover:text-white transition-colors">Site settings</span>
            </a>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6">
        <h2 class="text-sm font-bold text-white mb-5">Recent Activity</h2>
        @php
            $activities = \App\Models\ActivityLog::orderByDesc('created_at')->limit(8)->get();
        @endphp
        @if($activities->isEmpty())
            <p class="text-sm text-gray-600">No activity yet.</p>
        @else
            <div class="space-y-1">
                @foreach($activities as $activity)
                @php
                    $colors = [
                        'created'      => ['dot' => 'bg-emerald-400', 'text' => 'text-emerald-400'],
                        'updated'      => ['dot' => 'bg-indigo-400',  'text' => 'text-indigo-400'],
                        'deleted'      => ['dot' => 'bg-red-400',     'text' => 'text-red-400'],
                        'login'        => ['dot' => 'bg-violet-400',  'text' => 'text-violet-400'],
                        'failed_login' => ['dot' => 'bg-orange-400',  'text' => 'text-orange-400'],
                    ];
                    $color = $colors[$activity->action] ?? ['dot' => 'bg-gray-500', 'text' => 'text-gray-500'];
                @endphp
                <div class="flex items-center justify-between py-2.5 border-b border-white/[0.04] last:border-0">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $color['dot'] }}"></span>
                        <span class="text-xs text-gray-400 truncate">{{ $activity->description }}</span>
                    </div>
                    <span class="text-xs text-gray-600 shrink-0 ml-3">
                        {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                    </span>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

@endsection