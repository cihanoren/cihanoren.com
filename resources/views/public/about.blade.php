@extends('layouts.public')

@section('title', 'About — CihanÖren')

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-24 right-0 w-[500px] h-[500px] rounded-full bg-indigo-600/8 blur-[100px]"></div>
    </div>
    <div class="relative max-w-5xl mx-auto px-6 pt-24 pb-20">
        <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-4">About Me</p>
        <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6 max-w-2xl">
            Building mobile experiences
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400"> that actually work.</span>
        </h1>
        <p class="text-gray-400 text-lg max-w-xl leading-relaxed">
            I'm a Flutter developer focused on building clean, scalable mobile applications.
            I care deeply about architecture, code quality, and delivering great user experiences
            across iOS and Android.
        </p>
    </div>
</section>

{{-- Skills --}}
<section class="border-t border-white/5 bg-white/[0.015]">
    <div class="max-w-5xl mx-auto px-6 py-16">
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-10">Skills & Technologies</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Mobile --}}
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

            {{-- Backend & APIs --}}
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

            {{-- AI --}}
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

{{-- Experience Timeline --}}
<section class="max-w-5xl mx-auto px-6 py-20">
    <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-10">Experience</p>

    <div class="space-y-0">

        {{-- Item 1 --}}
        <div class="relative grid md:grid-cols-[200px_1fr] gap-6 pb-12">
            {{-- Timeline line --}}
            <div class="hidden md:block absolute left-[188px] top-3 bottom-0 w-px bg-white/[0.07]"></div>
            {{-- Dot --}}
            <div class="hidden md:flex absolute left-[183px] top-2.5 w-3 h-3 rounded-full bg-indigo-500 ring-4 ring-gray-950"></div>

            <div class="md:text-right">
                <p class="text-xs font-semibold text-indigo-400 tracking-wide uppercase">2023 — Present</p>
            </div>
            <div class="md:pl-10">
                <h3 class="text-white font-bold text-lg leading-tight">Flutter Developer</h3>
                <p class="text-gray-500 text-sm mt-0.5 mb-3">Company Name</p>
                <p class="text-gray-400 text-sm leading-relaxed max-w-lg">
                    Placeholder — admin panelden güncellenecek.
                </p>
            </div>
        </div>

        {{-- Item 2 --}}
        <div class="relative grid md:grid-cols-[200px_1fr] gap-6 pb-12">
            <div class="hidden md:block absolute left-[188px] top-3 bottom-0 w-px bg-white/[0.07]"></div>
            <div class="hidden md:flex absolute left-[183px] top-2.5 w-3 h-3 rounded-full bg-white/20 ring-4 ring-gray-950"></div>

            <div class="md:text-right">
                <p class="text-xs font-semibold text-gray-500 tracking-wide uppercase">2021 — 2023</p>
            </div>
            <div class="md:pl-10">
                <h3 class="text-white font-bold text-lg leading-tight">Mobile Developer</h3>
                <p class="text-gray-500 text-sm mt-0.5 mb-3">Company Name</p>
                <p class="text-gray-400 text-sm leading-relaxed max-w-lg">
                    Placeholder — admin panelden güncellenecek.
                </p>
            </div>
        </div>

    </div>
</section>

{{-- Education --}}
<section class="border-t border-white/5 bg-white/[0.015]">
    <div class="max-w-5xl mx-auto px-6 py-16">
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-10">Education</p>

        <div class="flex items-center gap-5 rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 max-w-lg">
            <div class="w-12 h-12 rounded-xl bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0H9m3 0h3"/>
                </svg>
            </div>
            <div>
                <h3 class="text-white font-bold">University Name</h3>
                <p class="text-gray-500 text-sm mt-0.5">Department — 20XX – 20XX</p>
            </div>
        </div>
    </div>
</section>

@endsection