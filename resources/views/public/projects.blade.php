@extends('layouts.public')

@section('title', __('messages.projects_label') . ' — CihanÖren')

@section('content')

{{-- favicon fallback (ensures the icon link exists in <head> for this page) --}}
<script>(function(){var l=document.querySelector("link[rel~='icon']");if(!l){l=document.createElement('link');document.head.appendChild(l);}l.rel='icon';l.type='image/png';l.href='/favicon.png';})();</script>

<div class="lux -mt-20">

    {{-- ambient --}}
    <div class="aurora" style="top:-8%; left:50%; transform:translateX(-50%); width:60vw; height:40vw; max-width:900px; max-height:560px;
         background: radial-gradient(circle at 50% 50%, rgba(129,140,248,.16), transparent 62%); animation: drift1 22s ease-in-out infinite;"></div>
    <div class="aurora" style="top:2%; right:6%; width:30vw; height:30vw; max-width:440px; max-height:440px;
         background: radial-gradient(circle at 50% 50%, rgba(34,211,238,.12), transparent 60%); animation: drift2 26s ease-in-out infinite;"></div>
    <div class="grain"></div>

    {{-- ── Hero ──────────────────────────────────────────────────────── --}}
    <section class="relative" style="z-index:2;">
        <div class="relative max-w-7xl mx-auto px-6 w-full pt-28 pb-14" style="z-index:2;">
            <div class="boot b1 flex items-center gap-4 mb-8">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.projects_label') }}</span>
            </div>
            <h1 class="boot b2 display font-semibold text-white leading-[0.98] mb-5 max-w-3xl"
                style="font-size: clamp(2.8rem, 7vw, 5.4rem);">
                {{ __('messages.projects_title') }}
            </h1>
            <p class="boot b3 text-zinc-400 text-lg max-w-lg leading-relaxed">{{ __('messages.projects_sub') }}</p>
        </div>
    </section>

    {{-- ── Grid ──────────────────────────────────────────────────────── --}}
    <section class="relative" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 pb-28">

            @if($projects->isEmpty())
                <div class="reveal-up rounded-3xl border border-dashed border-white/[0.1] p-16 flex flex-col items-center justify-center gap-4 text-center">
                    <div class="w-11 h-11 rounded-2xl bg-white/[0.03] border border-white/[0.08] flex items-center justify-center">
                        <svg class="w-5 h-5 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <p class="mono text-sm text-zinc-500">{{ __('messages.projects_soon') }}</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($projects as $project)
                    <a href="{{ route('projects.show', $project->slug) }}"
                       class="card reveal-up group relative rounded-3xl border border-white/[0.09] bg-white/[0.015]
                              hover:bg-white/[0.03] transition-all duration-500 overflow-hidden hover:-translate-y-1 {{ $loop->even ? 'rv-delay' : '' }}">

                        @if($project->cover_image)
                            <div class="relative w-full h-52 overflow-hidden">
                                <img src="{{ Storage::url($project->cover_image) }}"
                                     alt="{{ $project->title }}"
                                     class="w-full h-full object-cover opacity-85 group-hover:opacity-100 group-hover:scale-[1.05] transition-all duration-[900ms] ease-out">
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>
                            </div>
                        @endif

                        <div class="relative p-8">
                            <div class="flex items-center gap-3 mb-5">
                                <span class="mono text-[13px] text-zinc-600">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="h-px flex-1 bg-white/[0.07] group-hover:bg-white/20 transition-colors"></span>
                                <svg class="w-4 h-4 text-zinc-600 opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-white transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/>
                                </svg>
                            </div>
                            <h3 class="display text-white font-medium text-2xl mb-3">{{ $project->title }}</h3>
                            <p class="text-[15px] text-zinc-400 leading-relaxed mb-6 line-clamp-3">{{ $project->description }}</p>
                            @if($project->tags)
                                <div class="flex gap-x-2 gap-y-1 flex-wrap mono text-[12px] text-zinc-500">
                                    @foreach($project->tags as $tag)
                                        <span class="text-zinc-400">{{ $tag }}</span>
                                        @if(!$loop->last)<span class="text-zinc-700">·</span>@endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

</div>

@endsection