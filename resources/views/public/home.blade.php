@extends('layouts.public')

@section('title', 'CihanÖren — Flutter Developer')

@section('content')

{{-- Hero --}}
<section class="relative min-h-[92vh] flex items-center overflow-hidden">

    {{-- Background glow --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-32 -left-32 w-[600px] h-[600px] rounded-full bg-indigo-600/10 blur-[120px]"></div>
        <div class="absolute top-1/2 right-0 w-[400px] h-[400px] rounded-full bg-violet-600/8 blur-[100px]"></div>
        {{-- Grid overlay --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px); background-size: 48px 48px;"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-6 py-28 w-full">

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/10 mb-8">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-emerald-400 text-xs font-medium tracking-wide">Available for freelance work</span>
        </div>

        <h1 class="text-5xl md:text-[72px] font-black text-white leading-[1.05] tracking-tight mb-6">
            Flutter Developer<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">& Mobile Architect</span>
        </h1>

        <p class="text-gray-400 text-lg md:text-xl max-w-lg leading-relaxed mb-10">
            I build clean, scalable mobile applications with Flutter —
            focused on architecture, performance, and great UX.
        </p>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('projects.index') }}"
               class="group inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all duration-200 shadow-lg shadow-indigo-600/25">
                View Projects
                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 px-6 py-3 border border-white/10 hover:border-white/25 hover:bg-white/5 text-gray-300 hover:text-white rounded-xl font-semibold text-sm transition-all duration-200">
                Get in Touch
            </a>
        </div>

        {{-- Skills --}}
        <div class="mt-14 pt-12 border-t border-white/[0.06]">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-6">What I work with</p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- Mobile --}}
                <div class="rounded-2xl border border-white/[0.08] bg-white/[0.03] p-5">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-7 h-7 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-indigo-400 uppercase tracking-wide">Mobile</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Flutter', 'GetX', 'Clean Architecture', 'iOS & Android'] as $s)
                            <span class="px-2.5 py-1 rounded-md bg-white/[0.05] border border-white/[0.08] text-xs text-gray-300 font-medium">{{ $s }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Backend --}}
                <div class="rounded-2xl border border-white/[0.08] bg-white/[0.03] p-5">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-7 h-7 rounded-lg bg-violet-500/20 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-violet-400 uppercase tracking-wide">Backend</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['REST APIs', 'Firebase', 'Laravel'] as $s)
                            <span class="px-2.5 py-1 rounded-md bg-white/[0.05] border border-white/[0.08] text-xs text-gray-300 font-medium">{{ $s }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- AI --}}
                <div class="rounded-2xl border border-white/[0.08] bg-white/[0.03] p-5">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-7 h-7 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-emerald-400 uppercase tracking-wide">AI</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['LLM Integration', 'AI-Powered Apps'] as $s)
                            <span class="px-2.5 py-1 rounded-md bg-white/[0.05] border border-white/[0.08] text-xs text-gray-300 font-medium">{{ $s }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="flex flex-wrap gap-10 mt-10 pt-10 border-t border-white/[0.06]">
            <div>
                <p class="text-3xl font-black text-white">3+</p>
                <p class="text-sm text-gray-500 mt-0.5">Years experience</p>
            </div>
            <div>
                <p class="text-3xl font-black text-white">10+</p>
                <p class="text-sm text-gray-500 mt-0.5">Apps shipped</p>
            </div>
            <div>
                <p class="text-3xl font-black text-white">iOS & Android</p>
                <p class="text-sm text-gray-500 mt-0.5">Both platforms</p>
            </div>
        </div>
    </div>
</section>

{{-- Featured Projects --}}
<section class="max-w-5xl mx-auto px-6 py-24">
    <div class="flex items-end justify-between mb-12">
        <div>
            <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-2">Work</p>
            <h2 class="text-3xl font-black text-white">Featured Projects</h2>
        </div>
        <a href="{{ route('projects.index') }}"
           class="group inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-indigo-400 transition-colors pb-1">
            View all
            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        {{-- EduChamp card --}}
        <a href="{{ route('projects.show', 'educhamp') }}"
           class="group relative rounded-2xl border border-white/[0.08] bg-white/[0.02] p-7 hover:border-indigo-500/40 hover:bg-white/[0.04] transition-all duration-300 overflow-hidden">
            {{-- Card glow on hover --}}
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                <div class="absolute -top-8 -left-8 w-48 h-48 rounded-full bg-indigo-600/10 blur-[60px]"></div>
            </div>

            <div class="relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-11 h-11 rounded-xl bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <svg class="w-4 h-4 text-gray-700 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </div>

                <h3 class="text-white font-bold text-lg mb-2">EduChamp</h3>
                <p class="text-sm text-gray-400 leading-relaxed mb-5">
                    Educational management system for schools. Multi-role mobile app with Flutter & Clean Architecture.
                </p>
                <div class="flex gap-2 flex-wrap">
                    <span class="text-xs px-2.5 py-1 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-medium">Flutter</span>
                    <span class="text-xs px-2.5 py-1 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-medium">GetX</span>
                    <span class="text-xs px-2.5 py-1 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-medium">Laravel</span>
                </div>
            </div>
        </a>

        {{-- Placeholder card --}}
        <div class="rounded-2xl border border-dashed border-white/[0.07] p-7 flex flex-col items-center justify-center gap-3 text-center">
            <div class="w-10 h-10 rounded-xl bg-white/[0.03] border border-white/[0.07] flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <p class="text-gray-600 text-sm">More projects coming soon</p>
        </div>
    </div>
</section>

{{-- CTA strip --}}
<section class="border-t border-white/5">
    <div class="max-w-5xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center justify-between gap-8">
        <div>
            <h2 class="text-2xl font-black text-white mb-2">Have a project in mind?</h2>
            <p class="text-gray-500 text-sm">Let's build something great together.</p>
        </div>
        <a href="{{ route('contact') }}"
           class="shrink-0 inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-950 rounded-xl font-bold text-sm hover:bg-gray-100 transition-colors">
            Start a conversation
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>

@endsection