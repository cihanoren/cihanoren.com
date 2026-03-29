@extends('layouts.public')

@section('title', 'Resume — CihanÖren')

@section('content')
<section class="max-w-7xl mx-auto px-6 pt-24 pb-32">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-8 mb-20">
        <div>
            <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-3">Resume</p>
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight">Cihan Ören</h1>
            <p class="text-gray-400 mt-2 text-lg">Flutter Developer & Mobile Architect</p>
        </div>
        <a href="/cv.pdf" target="_blank"
           class="shrink-0 inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-indigo-500/50 bg-indigo-500/10 text-indigo-400 hover:bg-indigo-500 hover:text-white hover:border-indigo-500 transition-all duration-300 text-sm font-semibold self-start shadow-[0_0_20px_rgba(99,102,241,0.1)] hover:shadow-[0_0_20px_rgba(99,102,241,0.4)]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v4m0 0l-3-3m3 3l3-3M12 4v8"/>
            </svg>
            Download PDF
        </a>
    </div>

    <div class="border-t border-white/[0.06] mb-16"></div>

    {{-- Experience --}}
    <div class="mb-16">
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-12">Experience</p>

        @if($experiences->isEmpty())
            <p class="text-gray-600 text-sm">No experience added yet.</p>
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
                                    Current
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
    </div>

    <div class="border-t border-white/[0.06] mb-16"></div>

    {{-- Education --}}
    <div class="mb-16">
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-12">Education</p>

        @if($educations->isEmpty())
            <p class="text-gray-600 text-sm">No education added yet.</p>
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

    <div class="border-t border-white/[0.06] mb-16"></div>

    {{-- Skills --}}
    <div>
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-8">Skills</p>
        <div class="flex flex-wrap gap-2.5">
            @foreach(['Flutter', 'Clean Architecture', 'GetX', 'REST APIs', 'Firebase', 'iOS & Android', 'LLM Integration', 'AI-Powered Apps'] as $s)
                <span class="px-4 py-2 rounded-xl bg-white/[0.02] border border-white/[0.08] hover:border-indigo-500/30 hover:bg-indigo-500/5 transition-all duration-300 text-sm text-gray-300 font-medium cursor-default">
                    {{ $s }}
                </span>
            @endforeach
        </div>
    </div>

</section>
@endsection