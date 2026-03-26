@extends('layouts.public')

@section('title', 'Projects — CihanÖren')

@section('content')

<section class="relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[600px] h-[400px] rounded-full bg-indigo-600/8 blur-[100px]"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6 pt-24 pb-20">
        <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-4">Projects</p>
        <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-4">
            Things I've built.
        </h1>
        <p class="text-gray-500 text-lg max-w-lg">A collection of mobile apps, tools, and experiments.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 pb-24">
    @if($projects->isEmpty())
        <div class="rounded-2xl border border-dashed border-white/[0.07] p-16 flex flex-col items-center justify-center gap-3 text-center">
            <div class="w-10 h-10 rounded-xl bg-white/[0.03] border border-white/[0.07] flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <p class="text-gray-600 text-sm">Projects coming soon...</p>
        </div>
    @else
        <div class="grid md:grid-cols-2 gap-5">
            @foreach($projects as $project)
            <a href="{{ route('projects.show', $project->slug) }}"
               class="group relative rounded-2xl border border-white/[0.08] bg-white/[0.02] hover:border-indigo-500/40 hover:bg-white/[0.04] transition-all duration-300 overflow-hidden">

                {{-- Cover image --}}
                @if($project->cover_image)
                    <div class="w-full h-48 overflow-hidden">
                        <img src="{{ Storage::url($project->cover_image) }}"
                             alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                @endif

                {{-- Card glow on hover --}}
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    <div class="absolute -top-10 -left-10 w-48 h-48 rounded-full bg-indigo-600/10 blur-[60px]"></div>
                </div>

                <div class="relative p-7">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <svg class="w-4 h-4 text-gray-700 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>

                    <h3 class="text-white font-bold text-lg mb-2">{{ $project->title }}</h3>
                    <p class="text-sm text-gray-400 leading-relaxed mb-5">{{ $project->description }}</p>

                    @if($project->tags)
                        <div class="flex gap-2 flex-wrap">
                            @foreach($project->tags as $tag)
                                <span class="text-xs px-2.5 py-1 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-medium">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    @endif
</section>

@endsection