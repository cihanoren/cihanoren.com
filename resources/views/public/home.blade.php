@extends('layouts.public')

@section('title', Setting::get('site_title', 'CihanÖren — Flutter Developer'))

@section('content')

{{-- Hero --}}
<section class="relative min-h-[92vh] flex items-center overflow-hidden">

    {{-- Background glow --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-32 -left-32 w-[600px] h-[600px] rounded-full bg-indigo-600/10 blur-[120px]"></div>
        <div class="absolute top-1/2 right-0 w-[400px] h-[400px] rounded-full bg-violet-600/8 blur-[100px]"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px); background-size: 48px 48px;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-28 w-full">

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/10 mb-8">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-emerald-400 text-xs font-medium tracking-wide">{{ Setting::get('hero_badge', __('messages.home_badge')) }}</span>
        </div>

       @php
        $heroTitle = Setting::get('hero_title', 'Flutter Developer & Mobile Architect');
        $heroParts = explode('&', $heroTitle, 2);
        @endphp
        <h1 class="text-5xl md:text-[72px] font-black text-white leading-[1.05] tracking-tight mb-6">
            {{ trim($heroParts[0]) }}<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">&amp; {{ trim($heroParts[1] ?? '') }}</span>
        </h1>

        <p class="text-gray-400 text-lg md:text-xl max-w-lg leading-relaxed mb-10">
            {{ Setting::get('hero_subtitle', __('messages.home_hero_sub')) }}
        </p>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('projects.index') }}"
               class="group inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all duration-200 shadow-lg shadow-indigo-600/25">
                {{ __('messages.home_view_projects') }}
                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 px-6 py-3 border border-white/10 hover:border-white/25 hover:bg-white/5 text-gray-300 hover:text-white rounded-xl font-semibold text-sm transition-all duration-200">
                {{ __('messages.home_get_in_touch') }}
            </a>
        </div>

        {{-- Skills: Marquee --}}
        <div class="mt-14 pt-12 border-t border-white/[0.06]">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-6">{{ __('messages.home_skills_label') }}</p>
            <div class="overflow-hidden -mx-6">
                <style>
                    @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
                    .marquee-track { animation: marquee 22s linear infinite; display: flex; width: max-content; }
                    .marquee-track:hover { animation-play-state: paused; }
                </style>
                <div class="marquee-track px-6">
                    @php
                        $skillsRaw = Setting::get('skills', 'Flutter, Clean Architecture, GetX, REST APIs, Firebase, iOS & Android, LLM Integration, AI-Powered Apps');
                        $skills = array_map('trim', explode(',', $skillsRaw));
                    @endphp
                    @foreach(array_merge($skills, $skills) as $s)
                        <span class="inline-flex shrink-0 mx-2 px-6 py-3 rounded-full border border-white/[0.1] bg-white/[0.04] text-sm text-gray-300 font-semibold hover:border-indigo-500/40 hover:bg-indigo-500/10 hover:text-white transition-all duration-200 cursor-default">
                            {{ $s }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="flex flex-wrap gap-10 mt-10 pt-10 border-t border-white/[0.06]">
            <div>
                <p class="text-3xl font-black text-white">3+</p>
                <p class="text-sm text-gray-500 mt-0.5">{{ __('messages.home_years_exp') }}</p>
            </div>
            <div>
                <p class="text-3xl font-black text-white">10+</p>
                <p class="text-sm text-gray-500 mt-0.5">{{ __('messages.home_apps_shipped') }}</p>
            </div>
            <div>
                <p class="text-3xl font-black text-white">iOS & Android</p>
                <p class="text-sm text-gray-500 mt-0.5">{{ __('messages.home_both_platforms') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Featured Projects --}}
<section class="max-w-7xl mx-auto px-6 py-24">
    <div class="flex items-end justify-between mb-12">
        <div>
            <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-2">{{ __('messages.home_work_label') }}</p>
            <h2 class="text-3xl font-black text-white">{{ __('messages.home_featured') }}</h2>
        </div>
        <a href="{{ route('projects.index') }}"
           class="group inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-indigo-400 transition-colors pb-1">
            {{ __('messages.home_view_all') }}
            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        @forelse($featuredProjects as $project)
        <a href="{{ route('projects.show', $project->slug) }}"
           class="group relative rounded-2xl border border-white/[0.08] bg-white/[0.02] hover:border-indigo-500/40 hover:bg-white/[0.04] transition-all duration-300 overflow-hidden">

            {{-- Cover image --}}
            @if($project->cover_image)
                <div class="w-full h-44 overflow-hidden">
                    <img src="{{ Storage::url($project->cover_image) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            @endif

            {{-- Card glow --}}
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                <div class="absolute -top-8 -left-8 w-48 h-48 rounded-full bg-indigo-600/10 blur-[60px]"></div>
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
        @empty
        <div class="rounded-2xl border border-dashed border-white/[0.07] p-7 flex flex-col items-center justify-center gap-3 text-center col-span-2">
            <p class="text-gray-600 text-sm">{{ __('messages.home_projects_soon') }}</p>
        </div>
        @endforelse
    </div>
</section>

{{-- Admin shortcut (geliştirme kolaylığı - sonra kaldırılacak) --}}
<div class="fixed bottom-6 right-6 z-50">
    <a href="{{ route('admin.dashboard') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gray-900 border border-white/[0.1] text-gray-400 hover:text-white hover:border-indigo-500/50 text-xs font-medium transition-all shadow-xl">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
        Admin Panel
    </a>
</div>

{{-- CTA strip with inline chat --}}
<section class="border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 py-20">

        {{-- Default CTA --}}
        <div id="cta-default" class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
                <h2 class="text-2xl font-black text-white mb-2">{{ __('messages.home_cta_title') }}</h2>
                <p class="text-gray-500 text-sm">{{ __('messages.home_cta_sub') }}</p>
            </div>
            <button onclick="ctaOpenChat()"
                    class="shrink-0 inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-950 rounded-xl font-bold text-sm hover:bg-gray-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                {{ __('messages.home_cta_btn') }}
            </button>
        </div>

        {{-- Inline Chat Box --}}
        <div id="cta-chat" class="hidden max-w-3xl mx-auto">
            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] overflow-hidden">

                {{-- Chat Header --}}
                <div class="flex items-center gap-3 px-5 py-4 border-b border-white/[0.06]">
                    <div class="w-9 h-9 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714a2.25 2.25 0 001.591 1.591L21 14.5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Cihan's Assistant</p>
                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-xs text-gray-500">Online</span>
                        </div>
                    </div>
                    <button onclick="ctaCloseChat()" class="ml-auto text-gray-600 hover:text-white transition-colors p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Messages --}}
                <div id="cta-messages" class="px-5 py-4 space-y-3 overflow-y-auto" style="min-height: 380px; max-height: 520px;">
                    <div class="flex gap-2.5">
                        <div class="w-6 h-6 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5"/>
                            </svg>
                        </div>
                        <div class="bg-white/[0.05] border border-white/[0.06] rounded-2xl rounded-tl-sm px-4 py-2.5 max-w-sm">
                            <p class="text-sm text-gray-300 leading-relaxed">{{ __('messages.home_chat_welcome') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Input --}}
                <div class="px-4 py-3 border-t border-white/[0.06]">
                    <div class="flex items-center gap-2">
                        <input id="cta-input"
                               type="text"
                               placeholder="{{ __('messages.home_chat_placeholder') }}"
                               class="flex-1 px-4 py-2.5 rounded-xl bg-white/[0.05] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 transition-all">
                        <button id="cta-send"
                                class="w-9 h-9 rounded-xl bg-indigo-600 hover:bg-indigo-500 flex items-center justify-center shrink-0 transition-colors disabled:opacity-50">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
(function() {
    let ctaAnonId = localStorage.getItem('chat_anon_id');
    if (!ctaAnonId) {
        ctaAnonId = 'anon_' + Math.random().toString(36).substr(2, 16) + Date.now();
        localStorage.setItem('chat_anon_id', ctaAnonId);
    }

    let ctaLoading = false;

    window.ctaOpenChat = function() {
        document.getElementById('cta-default').classList.add('hidden');
        document.getElementById('cta-chat').classList.remove('hidden');
        document.getElementById('cta-input').focus();
    };

    window.ctaCloseChat = function() {
        document.getElementById('cta-chat').classList.add('hidden');
        document.getElementById('cta-default').classList.remove('hidden');
    };

    function ctaAddMessage(content, role) {
        const msgs = document.getElementById('cta-messages');
        const isUser = role === 'user';
        const div = document.createElement('div');
        div.className = 'flex gap-2.5' + (isUser ? ' justify-end' : '');
        div.innerHTML = isUser
            ? `<div class="bg-indigo-600 rounded-2xl rounded-tr-sm px-4 py-2.5 max-w-sm"><p class="text-sm text-white leading-relaxed">${ctaEscape(content)}</p></div>`
            : `<div class="w-6 h-6 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5"/></svg>
               </div>
               <div class="bg-white/[0.05] border border-white/[0.06] rounded-2xl rounded-tl-sm px-4 py-2.5 max-w-sm"><p class="text-sm text-gray-300 leading-relaxed">${ctaEscape(content)}</p></div>`;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
    }

    function ctaAddTyping() {
        const msgs = document.getElementById('cta-messages');
        const div = document.createElement('div');
        div.id = 'cta-typing';
        div.className = 'flex gap-2.5';
        div.innerHTML = `<div class="w-6 h-6 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5"/></svg>
        </div>
        <div class="bg-white/[0.05] border border-white/[0.06] rounded-2xl rounded-tl-sm px-4 py-3">
            <div class="flex gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-500 animate-bounce" style="animation-delay:0ms"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-500 animate-bounce" style="animation-delay:150ms"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-500 animate-bounce" style="animation-delay:300ms"></span>
            </div>
        </div>`;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
    }

    function ctaRemoveTyping() {
        const t = document.getElementById('cta-typing');
        if (t) t.remove();
    }

    function ctaEscape(text) {
        return text.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');
    }

    async function ctaSend() {
        const input = document.getElementById('cta-input');
        const sendBtn = document.getElementById('cta-send');
        const text = input.value.trim();
        if (!text || ctaLoading) return;

        ctaLoading = true;
        sendBtn.disabled = true;
        input.value = '';

        ctaAddMessage(text, 'user');
        ctaAddTyping();

        try {
            const res = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ message: text, anonymous_id: ctaAnonId }),
            });

            const data = await res.json();
            ctaRemoveTyping();
            ctaAddMessage(data.reply || 'Sorry, something went wrong.', 'assistant');
        } catch (e) {
            ctaRemoveTyping();
            ctaAddMessage('Connection error. Please try again.', 'assistant');
        } finally {
            ctaLoading = false;
            sendBtn.disabled = false;
            input.focus();
        }
    }

    document.getElementById('cta-send').addEventListener('click', ctaSend);
    document.getElementById('cta-input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); ctaSend(); }
    });
})();
</script>

@endsection