@extends('layouts.public')

@section('title', 'Resume — CihanÖren')

@section('content')

<section class="max-w-4xl mx-auto px-6 pt-24 pb-32">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-8 mb-20">
        <div>
            <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-3">Resume</p>
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight">CihanÖren</h1>
            <p class="text-gray-400 mt-2 text-lg">Flutter Developer & Mobile Architect</p>
        </div>
        <a href="/cv.pdf" target="_blank"
           class="shrink-0 inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-indigo-500/50 bg-indigo-500/10 text-indigo-400 hover:bg-indigo-500 hover:text-white hover:border-indigo-500 transition-all text-sm font-semibold self-start">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v4m0 0l-3-3m3 3l3-3M12 4v8"/>
            </svg>
            Download PDF
        </a>
    </div>

    {{-- Divider --}}
    <div class="border-t border-white/[0.06] mb-16"></div>

    {{-- Experience --}}
    <div class="mb-16">
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-10">Experience</p>
        <div class="space-y-10">

            <div class="grid md:grid-cols-[180px_1fr] gap-3 md:gap-10">
                <p class="text-sm text-gray-500 md:pt-0.5 shrink-0">2023 — Present</p>
                <div class="border-l border-white/[0.06] pl-6">
                    <h3 class="text-white font-bold text-base">Flutter Developer</h3>
                    <p class="text-indigo-400 text-xs font-medium mt-0.5 mb-3">Company Name</p>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Placeholder — admin panelden güncellenecek.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-[180px_1fr] gap-3 md:gap-10">
                <p class="text-sm text-gray-500 md:pt-0.5 shrink-0">2021 — 2023</p>
                <div class="border-l border-white/[0.06] pl-6">
                    <h3 class="text-white font-bold text-base">Mobile Developer</h3>
                    <p class="text-indigo-400 text-xs font-medium mt-0.5 mb-3">Company Name</p>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Placeholder — admin panelden güncellenecek.
                    </p>
                </div>
            </div>

        </div>
    </div>

    {{-- Divider --}}
    <div class="border-t border-white/[0.06] mb-16"></div>

    {{-- Education --}}
    <div class="mb-16">
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-10">Education</p>
        <div class="grid md:grid-cols-[180px_1fr] gap-3 md:gap-10">
            <p class="text-sm text-gray-500 md:pt-0.5 shrink-0">20XX — 20XX</p>
            <div class="border-l border-white/[0.06] pl-6">
                <h3 class="text-white font-bold text-base">University Name</h3>
                <p class="text-indigo-400 text-xs font-medium mt-0.5">Department</p>
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="border-t border-white/[0.06] mb-16"></div>

    {{-- Skills --}}
    <div>
        <p class="text-xs font-semibold tracking-widest uppercase text-indigo-400 mb-8">Skills</p>
        <div class="flex flex-wrap gap-2">
            @foreach(['Flutter', 'Clean Architecture', 'GetX', 'REST APIs', 'Firebase', 'iOS & Android', 'LLM Integration', 'AI-Powered Apps'] as $s)
                <span class="px-3.5 py-2 rounded-lg bg-white/[0.04] border border-white/[0.08] text-sm text-gray-300 font-medium">{{ $s }}</span>
            @endforeach
        </div>
    </div>

</section>

@endsection