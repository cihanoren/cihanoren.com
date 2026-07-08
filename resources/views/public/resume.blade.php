@extends('layouts.public')

@section('title', __('messages.resume_label') . ' — CihanÖren')

@section('content')

{{-- favicon fallback --}}
<script>(function(){var l=document.querySelector("link[rel~='icon']");if(!l){l=document.createElement('link');document.head.appendChild(l);}l.rel='icon';l.type='image/png';l.href='/favicon.png';})();</script>

@php
    $locale = app()->getLocale();
    $cvTr = Setting::get('cv_filename_tr', '');
    $cvEn = Setting::get('cv_filename_en', '');
    $primaryCv     = $locale === 'tr' ? ($cvTr ?: $cvEn) : ($cvEn ?: $cvTr);
    $secondaryCv   = $locale === 'tr' ? $cvEn : $cvTr;
    $secondaryLabel = $locale === 'tr' ? 'EN' : 'TR';
@endphp

<div class="lux -mt-20">

    {{-- ambient --}}
    <div class="aurora" style="top:-8%; right:-6%; width:46vw; height:46vw; max-width:720px; max-height:720px;
         background: radial-gradient(circle at 50% 50%, rgba(129,140,248,.16), transparent 62%); animation: drift1 22s ease-in-out infinite;"></div>
    <div class="grain"></div>

    {{-- ── Hero band ─────────────────────────────────────────────────── --}}
    <section class="relative" style="z-index:2;">
        <div class="relative max-w-7xl mx-auto px-6 pt-28 pb-10" style="z-index:2;">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div>
                    <div class="boot b1 flex items-center gap-4 mb-6">
                        <span class="h-px w-12 bg-white/25"></span>
                        <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.resume_label') }}</span>
                    </div>
                    <h1 class="boot b2 display font-semibold text-white leading-[0.98]" style="font-size: clamp(2.6rem, 6vw, 4.6rem);">Cihan Ören</h1>
                    <p class="boot b3 mono text-zinc-400 mt-3 text-sm">Flutter Developer &amp; Mobile Architect</p>
                </div>

                @if($primaryCv)
                <div class="boot b3 flex flex-col items-start md:items-end gap-2 shrink-0">
                    <a href="/{{ $primaryCv }}" target="_blank"
                       class="group inline-flex items-center gap-2.5 pl-6 pr-2 py-2 rounded-full bg-white text-black text-sm font-medium hover:bg-zinc-200 transition-colors">
                        {{ __('messages.resume_download') }}
                        <span class="w-8 h-8 rounded-full bg-black flex items-center justify-center">
                            <svg class="w-4 h-4 text-white group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v4m0 0l-3-3m3 3l3-3M12 4v8"/>
                            </svg>
                        </span>
                    </a>
                    @if($secondaryCv && $secondaryCv !== $primaryCv)
                        <a href="/{{ $secondaryCv }}" target="_blank" class="mono text-xs text-zinc-500 hover:text-white underline">
                            {{ $secondaryLabel }} version
                        </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ── Experience ────────────────────────────────────────────────── --}}
    <section class="relative border-t border-white/10" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="reveal-up flex items-center gap-4 mb-14">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.resume_experience') }}</span>
            </div>

            @if($experiences->isEmpty())
                <p class="mono text-sm text-zinc-500">{{ __('messages.resume_no_exp') }}</p>
            @else
                <div class="tl">
                    @foreach($experiences as $exp)
                    <div class="reveal-up grid grid-cols-[24px_1fr] md:grid-cols-[150px_24px_1fr] gap-x-5 md:gap-x-8 pb-12">
                        <div class="hidden md:flex justify-end pt-1">
                            <span class="mono text-[11px] tracking-wide uppercase {{ $exp->current ? 'text-cyan-300' : 'text-zinc-500' }}">{{ $exp->date_range }}</span>
                        </div>
                        <div class="relative flex justify-center pt-1.5">
                            @if(!$loop->last)<span class="tl-line"></span>@endif
                            <span class="tl-dot {{ $exp->current ? 'is-current' : '' }}"></span>
                        </div>
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
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.resume_education') }}</span>
            </div>

            @if($educations->isEmpty())
                <p class="mono text-sm text-zinc-500">{{ __('messages.resume_no_edu') }}</p>
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

    {{-- ── Skills ────────────────────────────────────────────────────── --}}
    <section class="relative border-t border-white/10" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="reveal-up flex items-center gap-4 mb-10">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.resume_skills') }}</span>
            </div>
            @php
                $skillCategories = json_decode(Setting::get('skill_categories', '[]'), true) ?: [];
                $skills = collect($skillCategories)
                    ->flatMap(fn($c) => array_map('trim', explode(',', $c['skills'] ?? '')))
                    ->filter()
                    ->values();
                if ($skills->isEmpty()) {
                    $skills = collect(explode(',', Setting::get('skills', 'Flutter, Clean Architecture, GetX, REST APIs, Firebase, iOS & Android, LLM Integration, AI-Powered Apps')))
                        ->map(fn($s) => trim($s));
                }
            @endphp
            <div class="reveal-up flex flex-wrap gap-2">
                @foreach($skills as $s)
                    <span class="skill-chip inline-flex items-center gap-2 pl-3 pr-3.5 py-1.5 rounded-full border border-white/[0.1] bg-white/[0.02] mono text-[13px] text-zinc-400 hover:text-white hover:bg-white/[0.04] hover:-translate-y-0.5 transition-all duration-300 cursor-default">
                        <span class="dot"></span>{{ $s }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

</div>

@endsection