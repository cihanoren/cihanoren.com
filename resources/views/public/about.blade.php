@extends('layouts.public')

@section('title', __('messages.about_label') . ' — CihanÖren')

@section('content')

@php
    $locale = app()->getLocale();
    $aboutTitle  = Setting::get("about_title_{$locale}", __('messages.about_title'));
    $aboutTitle2 = Setting::get("about_title2_{$locale}", __('messages.about_title2'));
    $aboutSub    = Setting::get("about_sub_{$locale}", __('messages.about_sub'));

    $defaultCategories = [
        ['icon' => 'mobile',  'title' => 'Mobile',         'skills' => 'Flutter, Dart, iOS & Android, GetX, Clean Architecture'],
        ['icon' => 'backend', 'title' => 'Backend & APIs', 'skills' => 'Laravel, REST APIs, Firebase'],
        ['icon' => 'ai',      'title' => 'AI',             'skills' => 'LLM Integration, AI-Powered Apps'],
    ];
    $skillCategories = json_decode(Setting::get('skill_categories', json_encode($defaultCategories)), true) ?: $defaultCategories;

    $categoryColors = [
        ['22', '211', '238'],   // cyan
        ['192', '132', '252'],  // purple
        ['244', '114', '182'],  // pink
        ['129', '140', '248'],  // indigo
        ['52', '211', '153'],   // emerald
        ['251', '191', '36'],   // amber
    ];

    $icons = [
        'mobile'   => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
        'backend'  => 'M5 12h14M12 5l7 7-7 7',
        'ai'       => 'M13 10V3L4 14h7v7l9-11h-7z',
        'code'     => 'M8 9l-4 3 4 3m8-6l4 3-4 3M14 4l-4 16',
        'database' => 'M4 7c0-1.66 3.58-3 8-3s8 1.34 8 3-3.58 3-8 3-8-1.34-8-3zm0 0v10c0 1.66 3.58 3 8 3s8-1.34 8-3V7M4 12c0 1.66 3.58 3 8 3s8-1.34 8-3',
        'cloud'    => 'M3 15a4 4 0 004 4h10a4 4 0 001-7.874A5.5 5.5 0 007.5 8.5 4 4 0 003 15z',
        'design'   => 'M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z',
        'globe'    => 'M3 12h18M12 3a15 15 0 010 18M12 3a15 15 0 000 18',
    ];
@endphp

<div class="lux -mt-20">

    {{-- ambient --}}
    <div class="aurora" style="top:-6%; right:-8%; width:46vw; height:46vw; max-width:720px; max-height:720px;
         background: radial-gradient(circle at 50% 50%, rgba(129,140,248,.18), transparent 62%); animation: drift1 20s ease-in-out infinite;"></div>
    <div class="aurora" style="top:8%; right:10%; width:30vw; height:30vw; max-width:460px; max-height:460px;
         background: radial-gradient(circle at 50% 50%, rgba(34,211,238,.13), transparent 60%); animation: drift2 24s ease-in-out infinite;"></div>
    <div class="grain"></div>

    {{-- ── Hero ──────────────────────────────────────────────────────── --}}
    <section class="relative" style="z-index:2;">
        <div class="relative max-w-7xl mx-auto px-6 w-full pt-28 pb-16" style="z-index:2;">
            <div class="boot b1 flex items-center gap-4 mb-8">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.about_label') }}</span>
            </div>
            <h1 class="boot b2 display font-semibold text-white leading-[0.98] mb-7 max-w-3xl"
                style="font-size: clamp(2.6rem, 6.5vw, 5rem);">
                {{ $aboutTitle }}
                <span class="grad">{{ $aboutTitle2 }}</span>
            </h1>
            <p class="boot b3 text-zinc-300 text-lg max-w-xl leading-relaxed">{{ $aboutSub }}</p>
        </div>
    </section>

    {{-- ── Skills ────────────────────────────────────────────────────── --}}
    <section class="relative border-t border-white/10" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="reveal-up flex items-center gap-4 mb-12">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.about_skills') }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($skillCategories as $i => $cat)
                    @php
                        [$r, $g, $b] = $categoryColors[$i % count($categoryColors)];
                        $iconBg    = "background: rgba($r, $g, $b, 0.12); border: 1px solid rgba($r, $g, $b, 0.25);";
                        $iconColor = "color: rgb($r, $g, $b);";
                        $iconPath  = $icons[$cat['icon']] ?? $icons['code'];
                        $chips     = array_filter(array_map('trim', explode(',', $cat['skills'])));
                    @endphp
                    <div class="card reveal-up rounded-3xl border border-white/[0.09] bg-white/[0.015] p-7 hover:bg-white/[0.03] transition-colors duration-500">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-6" style="{{ $iconBg }}">
                            <svg class="w-4 h-4" style="{{ $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"/>
                            </svg>
                        </div>
                        <p class="display text-white font-medium text-lg mb-5">{{ $cat['title'] }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($chips as $s)
                                <span class="skill-chip inline-flex items-center gap-2 pl-3 pr-3.5 py-1.5 rounded-full border border-white/[0.1] bg-white/[0.02] mono text-[12px] text-zinc-400 hover:text-white hover:bg-white/[0.04] transition-colors cursor-default">
                                    <span class="dot"></span>{{ $s }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Experience ────────────────────────────────────────────────── --}}
    <section class="relative border-t border-white/10" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="reveal-up flex items-center gap-4 mb-14">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.about_experience') }}</span>
            </div>

            @if($experiences->isEmpty())
                <p class="mono text-sm text-zinc-500">{{ __('messages.about_no_exp') }}</p>
            @else
                <div class="tl">
                    @foreach($experiences as $exp)
                    <div class="reveal-up grid grid-cols-[24px_1fr] md:grid-cols-[150px_24px_1fr] gap-x-5 md:gap-x-8 pb-12">
                        {{-- date (desktop) --}}
                        <div class="hidden md:flex justify-end pt-1">
                            <span class="mono text-[11px] tracking-wide uppercase {{ $exp->current ? 'text-cyan-300' : 'text-zinc-500' }}">{{ $exp->date_range }}</span>
                        </div>
                        {{-- rail --}}
                        <div class="relative flex justify-center pt-1.5">
                            @if(!$loop->last)<span class="tl-line"></span>@endif
                            <span class="tl-dot {{ $exp->current ? 'is-current' : '' }}"></span>
                        </div>
                        {{-- content --}}
                        <div>
                            <div class="md:hidden mb-3">
                                <span class="mono text-[11px] tracking-wide uppercase {{ $exp->current ? 'text-cyan-300' : 'text-zinc-500' }}">{{ $exp->date_range }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-2">
                                <h3 class="display text-white font-medium text-xl">{{ $exp->position }}</h3>
                                @if($exp->current)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full mono text-[11px] tracking-wide uppercase w-fit"
                                          style="background:rgba(129,140,248,.12); border:1px solid rgba(129,140,248,.3); color:#c7d2fe;">
                                        <span class="w-1.5 h-1.5 rounded-full animate-pulse" style="background:linear-gradient(135deg,#22d3ee,#c084fc);"></span>
                                        {{ __('messages.current') }}
                                    </span>
                                @endif
                            </div>
                            <div class="mono text-[13px] flex items-center flex-wrap gap-2 mb-4">
                                <span class="text-zinc-300">{{ $exp->company }}</span>
                                @if($exp->location)
                                    <span class="text-zinc-700">·</span>
                                    <span class="text-zinc-500">{{ $exp->location }}</span>
                                @endif
                            </div>
                            @if($exp->description)
                                <div class="card rounded-2xl border border-white/[0.06] bg-white/[0.015] p-5 max-w-2xl transition-colors duration-500 hover:bg-white/[0.025]">
                                    <p class="text-[15px] text-zinc-400 leading-relaxed">{{ $exp->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ── Education ─────────────────────────────────────────────────── --}}
    <section class="relative border-t border-white/10" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="reveal-up flex items-center gap-4 mb-14">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.about_education') }}</span>
            </div>

            @if($educations->isEmpty())
                <p class="mono text-sm text-zinc-500">{{ __('messages.about_no_edu') }}</p>
            @else
                <div class="tl">
                    @foreach($educations as $edu)
                    <div class="reveal-up grid grid-cols-[24px_1fr] md:grid-cols-[150px_24px_1fr] gap-x-5 md:gap-x-8 pb-12">
                        <div class="hidden md:flex justify-end pt-1">
                            <span class="mono text-[11px] tracking-wide uppercase text-zinc-500">{{ $edu->date_range }}</span>
                        </div>
                        <div class="relative flex justify-center pt-1.5">
                            @if(!$loop->last)<span class="tl-line"></span>@endif
                            <span class="tl-dot"></span>
                        </div>
                        <div>
                            <div class="md:hidden mb-3">
                                <span class="mono text-[11px] tracking-wide uppercase text-zinc-500">{{ $edu->date_range }}</span>
                            </div>
                            <h3 class="display text-white font-medium text-xl mb-2">{{ $edu->school }}</h3>
                            <div class="mono text-[13px] flex items-center flex-wrap gap-2">
                                <span class="text-cyan-300">{{ $edu->department }}</span>
                                @if($edu->degree)
                                    <span class="text-zinc-700">·</span>
                                    <span class="text-zinc-500">{{ $edu->degree }}</span>
                                @endif
                            </div>
                            @if($edu->description)
                                <div class="card rounded-2xl border border-white/[0.06] bg-white/[0.015] p-5 max-w-2xl mt-4 transition-colors duration-500 hover:bg-white/[0.025]">
                                    <p class="text-[15px] text-zinc-400 leading-relaxed">{{ $edu->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

</div>

@endsection