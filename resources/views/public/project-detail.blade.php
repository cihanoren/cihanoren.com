@extends('layouts.public')

@section('title', $project->title . ' — CihanÖren')
@section('description', $project->description)

@section('content')

{{-- favicon fallback --}}
<script>(function(){var l=document.querySelector("link[rel~='icon']");if(!l){l=document.createElement('link');document.head.appendChild(l);}l.rel='icon';l.type='image/png';l.href='/favicon.png';})();</script>

<div class="lux -mt-20">

    {{-- ambient --}}
    <div class="aurora" style="top:-8%; left:-8%; width:46vw; height:46vw; max-width:720px; max-height:720px;
         background: radial-gradient(circle at 50% 50%, rgba(129,140,248,.16), transparent 62%); animation: drift1 22s ease-in-out infinite;"></div>
    <div class="grain"></div>

    {{-- ── Hero band ─────────────────────────────────────────────────── --}}
    <section class="relative" style="z-index:2;">
        <div class="relative max-w-7xl mx-auto px-6 pt-28 pb-10" style="z-index:2;">

            <a href="{{ route('projects.index') }}"
               class="boot b1 inline-flex items-center gap-2 mono text-[13px] text-zinc-500 hover:text-white transition-colors mb-10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                {{ __('messages.project_back') }}
            </a>

            <h1 class="boot b2 display font-semibold text-white leading-[0.98] mb-5 max-w-4xl"
                style="font-size: clamp(2.6rem, 6.5vw, 5rem);">
                {{ $project->title }}
            </h1>

            <p class="boot b3 text-zinc-300 text-lg leading-relaxed max-w-2xl">{{ $project->description }}</p>

            @if($project->tags)
                <div class="boot b3 flex flex-wrap gap-2 mt-7">
                    @foreach($project->tags as $tag)
                        <span class="skill-chip inline-flex items-center gap-2 pl-3 pr-3.5 py-1.5 rounded-full border border-white/[0.1] bg-white/[0.02] mono text-[12px] text-zinc-400 hover:text-white hover:bg-white/[0.04] hover:-translate-y-0.5 transition-all duration-300 cursor-default">
                            <span class="dot"></span>{{ $tag }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ── Body ──────────────────────────────────────────────────────── --}}
    <section class="relative" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 pb-28">
            <div class="grid lg:grid-cols-[1fr_320px] gap-12">

                {{-- Left: content --}}
                <div>
                    @if($project->cover_image)
                        <div class="reveal-up w-full rounded-3xl overflow-hidden border border-white/[0.09] mb-10">
                            <img src="{{ Storage::url($project->cover_image) }}"
                                 alt="{{ $project->title }}"
                                 class="w-full object-cover max-h-[420px]">
                        </div>
                    @endif

                    @if($project->content)
                        <div class="reveal-up text-[15px] md:text-base text-zinc-300 leading-relaxed">
                            {!! nl2br(e($project->content)) !!}
                        </div>
                    @endif
                </div>

                {{-- Right: links & CTA --}}
                <div class="space-y-4">

                    @if($project->project_url || $project->github_url || $project->appstore_url || $project->playstore_url)
                    <div class="card reveal-up rounded-3xl border border-white/[0.09] bg-white/[0.015] p-6">
                        <p class="mono text-[11px] tracking-[0.16em] uppercase text-zinc-500 mb-4">{{ __('messages.project_links') }}</p>
                        <div class="space-y-2.5">

                            @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" rel="noopener"
                               class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/[0.03] border border-white/[0.07] hover:border-white/25 hover:bg-white/[0.05] transition-all group">
                                <span class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(34,211,238,.14)">
                                    <svg class="w-4 h-4" style="color:#22d3ee" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>
                                    </svg>
                                </span>
                                <span class="text-sm text-zinc-400 group-hover:text-white transition-colors">{{ __('messages.project_website') }}</span>
                                <svg class="w-3.5 h-3.5 text-zinc-600 ml-auto group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                            </a>
                            @endif

                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener"
                               class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/[0.03] border border-white/[0.07] hover:border-white/25 hover:bg-white/[0.05] transition-all group">
                                <span class="w-8 h-8 rounded-xl bg-white/[0.06] flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-zinc-200" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                    </svg>
                                </span>
                                <span class="text-sm text-zinc-400 group-hover:text-white transition-colors">GitHub</span>
                                <svg class="w-3.5 h-3.5 text-zinc-600 ml-auto group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                            </a>
                            @endif

                            @if($project->appstore_url)
                            <a href="{{ $project->appstore_url }}" target="_blank" rel="noopener"
                               class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/[0.03] border border-white/[0.07] hover:border-white/25 hover:bg-white/[0.05] transition-all group">
                                <span class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(56,189,248,.14)">
                                    <svg class="w-4 h-4" style="color:#38bdf8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                    </svg>
                                </span>
                                <span class="text-sm text-zinc-400 group-hover:text-white transition-colors">App Store</span>
                                <svg class="w-3.5 h-3.5 text-zinc-600 ml-auto group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                            </a>
                            @endif

                            @if($project->playstore_url)
                            <a href="{{ $project->playstore_url }}" target="_blank" rel="noopener"
                               class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/[0.03] border border-white/[0.07] hover:border-white/25 hover:bg-white/[0.05] transition-all group">
                                <span class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(52,211,153,.14)">
                                    <svg class="w-4 h-4" style="color:#34d399" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3.18 23.76c.3.17.65.19.97.07L13.86 12 3.18 23.76zM.15 1.17C.06 1.38 0 1.62 0 1.89v20.22c0 .27.06.51.15.72L12.16 12 .15 1.17zM20.23 10.55l-2.79-1.6L14.2 12l3.24 3.05 2.79-1.6c.8-.46.8-1.9 0-2.9zM3.18.24L13.86 12 3.18 23.76c.32.12.67.1.97-.07l13.5-7.75c.8-.46.8-1.9 0-2.9L4.15.31C3.83.13 3.48.12 3.18.24z"/>
                                    </svg>
                                </span>
                                <span class="text-sm text-zinc-400 group-hover:text-white transition-colors">Play Store</span>
                                <svg class="w-3.5 h-3.5 text-zinc-600 ml-auto group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                            </a>
                            @endif

                        </div>
                    </div>
                    @endif

                    {{-- CTA --}}
                    <div class="card reveal-up rounded-3xl border border-white/[0.09] bg-white/[0.015] p-6">
                        <p class="display text-white font-medium text-lg mb-2">{{ __('messages.project_cta_title') }}</p>
                        <p class="text-sm text-zinc-500 mb-5 leading-relaxed">{{ __('messages.project_cta_sub') }}</p>
                        <a href="{{ route('contact') }}"
                           class="group w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-white text-black text-sm font-medium hover:bg-zinc-200 transition-colors">
                            {{ __('messages.project_cta_btn') }}
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

@endsection