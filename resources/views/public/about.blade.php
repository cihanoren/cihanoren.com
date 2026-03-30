@extends('layouts.public')

@section('title', __('messages.about_label') . ' — CihanÖren')

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-indigo-600/8 blur-[100px]"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6 pt-24 pb-20">
        <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-4">{{ __('messages.about_label') }}</p>
        <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6 max-w-2xl">
            {{ __('messages.about_title') }}
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400"> {{ __('messages.about_title2') }}</span>
        </h1>
        <p class="text-gray-400 text-lg max-w-xl leading-relaxed">
            {{ __('messages.about_sub') }}
        </p>
    </div>
</section>

{{-- Skills --}}
<section class="border-t border-white/5 bg-white/[0.015]">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-10">{{ __('messages.about_skills') }}</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6">
                <div class="w-9 h-9 rounded-lg bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center mb-5">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-white font-bold text-sm mb-4">Mobile</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Flutter', 'Dart', 'iOS & Android', 'GetX', 'Clean Architecture'] as $s)
                        <span class="px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-xs text-gray-300 font-medium">{{ $s }}</span>
                    @endforeach
                </div>
            </div>
            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6">
                <div class="w-9 h-9 rounded-lg bg-violet-500/15 border border-violet-500/20 flex items-center justify-center mb-5">
                    <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </div>
                <p class="text-white font-bold text-sm mb-4">Backend & APIs</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Laravel', 'REST APIs', 'Firebase'] as $s)
                        <span class="px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-xs text-gray-300 font-medium">{{ $s }}</span>
                    @endforeach
                </div>
            </div>
            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6">
                <div class="w-9 h-9 rounded-lg bg-emerald-500/15 border border-emerald-500/20 flex items-center justify-center mb-5">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <p class="text-white font-bold text-sm mb-4">AI</p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['LLM Integration', 'AI-Powered Apps'] as $s)
                        <span class="px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-xs text-gray-300 font-medium">{{ $s }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Experience --}}
<section class="max-w-7xl mx-auto px-6 py-20">
    <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-12">{{ __('messages.about_experience') }}</p>

    @if($experiences->isEmpty())
        <p class="text-gray-600 text-sm">{{ __('messages.about_no_exp') }}</p>
    @else
        <div class="space-y-0">
            @foreach($experiences as $index => $exp)
            <div class="group relative grid grid-cols-[auto_1fr] md:grid-cols-[200px_auto_1fr] gap-5 md:gap-8 pb-12">
                <div class="hidden md:block text-right pt-1">
                    <span class="text-xs font-semibold tracking-widest {{ $exp->current ? 'text-indigo-400' : 'text-gray-500' }} uppercase bg-white/[0.02] border border-white/[0.05] px-3.5 py-1.5 rounded-lg inline-block transition-colors group-hover:bg-white/[0.04]">
                        {{ $exp->date_range }}
                    </span>
                </div>
                <div class="relative flex flex-col items-center w-6">
                    @if(!$loop->last)
                        <div class="absolute top-8 -bottom-12 w-px bg-white/10 group-hover:bg-indigo-500/40 transition-colors duration-500"></div>
                    @endif
                    <div class="w-6 h-6 rounded-full bg-gray-950 border-2 {{ $exp->current ? 'border-indigo-500' : 'border-white/10 group-hover:border-white/30' }} flex items-center justify-center relative z-10 mt-0.5 transition-colors duration-300">
                        <div class="w-2 h-2 rounded-full {{ $exp->current ? 'bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,0.8)]' : 'bg-white/20 group-hover:bg-white/50' }} transition-all duration-300"></div>
                    </div>
                </div>
                <div class="pt-0.5">
                    <div class="md:hidden mb-3">
                        <span class="text-xs font-semibold tracking-widest {{ $exp->current ? 'text-indigo-400' : 'text-gray-500' }} uppercase bg-white/[0.02] border border-white/[0.05] px-3 py-1 rounded-lg inline-block">
                            {{ $exp->date_range }}
                        </span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-2">
                        <h3 class="text-white font-bold text-xl">{{ $exp->position }}</h3>
                        @if($exp->current)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[11px] font-bold tracking-wider uppercase w-fit">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                                {{ __('messages.current') }}
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center flex-wrap gap-2 text-sm mb-4">
                        <span class="flex items-center gap-1.5 font-medium text-gray-300">
                            <svg class="w-4 h-4 text-indigo-400/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            {{ $exp->company }}
                        </span>
                        @if($exp->location)
                            <span class="text-gray-600 px-1">•</span>
                            <span class="flex items-center gap-1.5 text-gray-400">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $exp->location }}
                            </span>
                        @endif
                    </div>
                    @if($exp->description)
                        <div class="text-gray-400 text-sm leading-relaxed bg-white/[0.015] border border-white/[0.04] rounded-xl p-5 group-hover:border-white/[0.08] group-hover:bg-white/[0.025] transition-all duration-300 shadow-sm">
                            {{ $exp->description }}
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif
</section>

{{-- Education --}}
<section class="border-t border-white/5 bg-white/[0.015]">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-12">{{ __('messages.about_education') }}</p>

        @if($educations->isEmpty())
            <p class="text-gray-600 text-sm">{{ __('messages.about_no_edu') }}</p>
        @else
            <div class="space-y-0">
                @foreach($educations as $edu)
                <div class="group relative grid grid-cols-[auto_1fr] md:grid-cols-[200px_auto_1fr] gap-5 md:gap-8 pb-10">
                    <div class="hidden md:block text-right pt-1">
                        <span class="text-xs font-semibold tracking-widest text-gray-500 uppercase bg-white/[0.02] border border-white/[0.05] px-3.5 py-1.5 rounded-lg inline-block transition-colors group-hover:bg-white/[0.04]">
                            {{ $edu->date_range }}
                        </span>
                    </div>
                    <div class="relative flex flex-col items-center w-6">
                        @if(!$loop->last)
                            <div class="absolute top-8 -bottom-10 w-px bg-white/10 group-hover:bg-indigo-500/30 transition-colors duration-500"></div>
                        @endif
                        <div class="w-6 h-6 rounded-full bg-gray-950 border-2 border-white/10 group-hover:border-white/30 flex items-center justify-center relative z-10 mt-0.5 transition-colors duration-300">
                            <div class="w-2 h-2 rounded-full bg-white/20 group-hover:bg-white/50 transition-all duration-300"></div>
                        </div>
                    </div>
                    <div class="pt-0.5">
                        <div class="md:hidden mb-3">
                            <span class="text-xs font-semibold tracking-widest text-gray-500 uppercase bg-white/[0.02] border border-white/[0.05] px-3 py-1 rounded-lg inline-block">
                                {{ $edu->date_range }}
                            </span>
                        </div>
                        <h3 class="text-white font-bold text-xl mb-2">{{ $edu->school }}</h3>
                        <div class="flex items-center flex-wrap gap-2 text-sm mb-2">
                            <span class="flex items-center gap-1.5 font-medium text-indigo-400">
                                <svg class="w-4 h-4 text-indigo-400/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0H9m3 0h3"/>
                                </svg>
                                {{ $edu->department }}
                            </span>
                            @if($edu->degree)
                                <span class="text-gray-600">·</span>
                                <span class="text-gray-500 text-xs">{{ $edu->degree }}</span>
                            @endif
                        </div>
                        @if($edu->description)
                            <div class="text-gray-400 text-sm leading-relaxed bg-white/[0.015] border border-white/[0.04] rounded-xl p-5 group-hover:border-white/[0.08] group-hover:bg-white/[0.025] transition-all duration-300 shadow-sm">
                                {{ $edu->description }}
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection