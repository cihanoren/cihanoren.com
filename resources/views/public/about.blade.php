@extends('layouts.public')

@section('title', __('messages.about_label') . ' — CihanÖren')

@section('content')

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
                {{ __('messages.about_title') }}
                <span class="grad">{{ __('messages.about_title2') }}</span>
            </h1>
            <p class="boot b3 text-zinc-300 text-lg max-w-xl leading-relaxed">{{ __('messages.about_sub') }}</p>
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

                {{-- Mobile --}}
                <div class="card reveal-up rounded-3xl border border-white/[0.09] bg-white/[0.015] p-7 hover:bg-white/[0.03] transition-colors duration-500">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-6" style="background:rgba(34,211,238,.12); border:1px solid rgba(34,211,238,.25);">
                        <svg class="w-4 h-4" style="color:#22d3ee" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="display text-white font-medium text-lg mb-5">Mobile</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Flutter', 'Dart', 'iOS & Android', 'GetX', 'Clean Architecture'] as $s)
                            <span class="skill-chip inline-flex items-center gap-2 pl-3 pr-3.5 py-1.5 rounded-full border border-white/[0.1] bg-white/[0.02] mono text-[12px] text-zinc-400 hover:text-white hover:bg-white/[0.04] transition-colors cursor-default">
                                <span class="dot"></span>{{ $s }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Backend & APIs --}}
                <div class="card reveal-up rounded-3xl border border-white/[0.09] bg-white/[0.015] p-7 hover:bg-white/[0.03] transition-colors duration-500">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-6" style="background:rgba(192,132,252,.12); border:1px solid rgba(192,132,252,.25);">
                        <svg class="w-4 h-4" style="color:#c084fc" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </div>
                    <p class="display text-white font-medium text-lg mb-5">Backend &amp; APIs</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Laravel', 'REST APIs', 'Firebase'] as $s)
                            <span class="skill-chip inline-flex items-center gap-2 pl-3 pr-3.5 py-1.5 rounded-full border border-white/[0.1] bg-white/[0.02] mono text-[12px] text-zinc-400 hover:text-white hover:bg-white/[0.04] transition-colors cursor-default">
                                <span class="dot"></span>{{ $s }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- AI --}}
                <div class="card reveal-up rounded-3xl border border-white/[0.09] bg-white/[0.015] p-7 hover:bg-white/[0.03] transition-colors duration-500">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-6" style="background:rgba(244,114,182,.12); border:1px solid rgba(244,114,182,.25);">
                        <svg class="w-4 h-4" style="color:#f472b6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <p class="display text-white font-medium text-lg mb-5">AI</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['LLM Integration', 'AI-Powered Apps'] as $s)
                            <span class="skill-chip inline-flex items-center gap-2 pl-3 pr-3.5 py-1.5 rounded-full border border-white/[0.1] bg-white/[0.02] mono text-[12px] text-zinc-400 hover:text-white hover:bg-white/[0.04] transition-colors cursor-default">
                                <span class="dot"></span>{{ $s }}
                            </span>
                        @endforeach
                    </div>
                </div>

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