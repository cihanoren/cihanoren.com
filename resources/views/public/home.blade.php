@extends('layouts.public')

@section('title', 'CihanÖren — Flutter Developer')

@section('content')

{{-- Hero --}}
<section class="min-h-[90vh] flex items-center">
    <div class="max-w-5xl mx-auto px-6 py-24">
        <p class="text-indigo-400 text-sm font-medium tracking-widest uppercase mb-4">
            Available for freelance work
        </p>
        <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight mb-6">
            Flutter Developer<br>
            <span class="text-gray-500">& Mobile Architect</span>
        </h1>
        <p class="text-gray-400 text-lg md:text-xl max-w-xl leading-relaxed mb-10">
            I build clean, scalable mobile applications with Flutter.
            Focused on architecture, performance, and great user experience.
        </p>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('projects.index') }}"
               class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-medium transition-colors">
                View Projects
            </a>
            <a href="{{ route('contact') }}"
               class="px-6 py-3 border border-white/10 hover:border-white/30 text-gray-300 hover:text-white rounded-lg font-medium transition-colors">
                Get in Touch
            </a>
        </div>
    </div>
</section>

{{-- Skills strip --}}
<section class="border-y border-white/5 py-10 bg-white/[0.02]">
    <div class="max-w-5xl mx-auto px-6">
        <div class="flex flex-wrap gap-3">
            @foreach(['Flutter', 'Dart', 'Laravel', 'Clean Architecture', 'GetX', 'REST APIs', 'Firebase', 'iOS & Android'] as $skill)
            <span class="px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-sm text-gray-400">
                {{ $skill }}
            </span>
            @endforeach
        </div>
    </div>
</section>

{{-- Featured Projects placeholder --}}
<section class="max-w-5xl mx-auto px-6 py-24">
    <div class="flex items-center justify-between mb-12">
        <h2 class="text-2xl font-bold text-white">Featured Projects</h2>
        <a href="{{ route('projects.index') }}" class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors">
            View all →
        </a>
    </div>
    <div class="grid md:grid-cols-2 gap-6">
        {{-- Projeler DB'den gelecek, şimdilik placeholder --}}
        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-6 hover:border-indigo-500/50 transition-colors">
            <div class="w-10 h-10 rounded-lg bg-indigo-500/20 flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="font-semibold text-white mb-2">EduChamp</h3>
            <p class="text-sm text-gray-400 leading-relaxed mb-4">
                Educational management system for schools. Multi-role mobile app built with Flutter & Clean Architecture.
            </p>
            <div class="flex gap-2 flex-wrap">
                <span class="text-xs px-2 py-1 rounded bg-indigo-500/10 text-indigo-400">Flutter</span>
                <span class="text-xs px-2 py-1 rounded bg-indigo-500/10 text-indigo-400">GetX</span>
                <span class="text-xs px-2 py-1 rounded bg-indigo-500/10 text-indigo-400">Laravel</span>
            </div>
        </div>
        {{-- İkinci kart --}}
        <div class="rounded-xl border border-dashed border-white/10 p-6 flex items-center justify-center text-gray-600 text-sm">
            More projects coming soon...
        </div>
    </div>
</section>

@endsection