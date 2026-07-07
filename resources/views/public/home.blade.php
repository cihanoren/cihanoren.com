@extends('layouts.public')

@section('title', Setting::get('site_title', 'CihanÖren — Flutter Developer'))

@section('content')


<div class="lux -mt-20">

    {{-- ambient aurora --}}
    <div class="aurora" style="top:-10%; right:-6%; width:52vw; height:52vw; max-width:820px; max-height:820px;
         background: radial-gradient(circle at 50% 50%, rgba(129,140,248,.22), transparent 62%); animation: drift1 18s ease-in-out infinite;"></div>
    <div class="aurora" style="top:20%; right:6%; width:34vw; height:34vw; max-width:520px; max-height:520px;
         background: radial-gradient(circle at 50% 50%, rgba(34,211,238,.16), transparent 60%); animation: drift2 22s ease-in-out infinite;"></div>

    {{-- film grain --}}
    <div class="grain"></div>

    {{-- ── Hero ──────────────────────────────────────────────────────── --}}
    <section class="relative min-h-[92vh] flex flex-col">

        <div class="relative flex-1 flex flex-col justify-center max-w-7xl mx-auto px-6 w-full pt-28 pb-10" style="z-index:2;">

            {{-- eyebrow --}}
            <div class="boot b1 flex items-center gap-4 mb-9">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">
                    {{ Setting::get('hero_badge', __('messages.home_badge')) }}
                </span>
            </div>

            @php
                $heroTitle = Setting::get('hero_title', 'Flutter Developer & Mobile Architect');
                $heroParts = explode('&', $heroTitle, 2);
            @endphp
            <h1 class="display font-semibold text-white leading-[0.94] mb-9"
                style="font-size: clamp(3.1rem, 9vw, 7.4rem);">
                <span class="boot b2 block">{{ trim($heroParts[0]) }}</span>
                <span class="boot b3 block">
                    <span class="text-white/25 font-medium">&amp;</span>
                    <span class="grad">{{ trim($heroParts[1] ?? '') }}</span>
                </span>
            </h1>

            <p class="boot b4 text-zinc-300 leading-relaxed mb-8 max-w-xl"
               style="font-size: clamp(1.05rem, 1.4vw, 1.3rem);">
                {{ Setting::get('hero_subtitle', __('messages.home_hero_sub')) }}
            </p>

            {{-- tech stack chips --}}
            @php
                $skillsRaw = Setting::get('skills', 'Flutter, Clean Architecture, GetX, REST APIs, Firebase, iOS & Android, LLM Integration, AI-Powered Apps');
                $skills = array_map('trim', explode(',', $skillsRaw));
            @endphp
            <div class="boot b5 mb-11 flex flex-wrap gap-2 max-w-2xl">
                @foreach($skills as $s)
                    <span class="skill-chip inline-flex items-center gap-2 pl-3 pr-3.5 py-1.5 rounded-full border border-white/[0.1] bg-white/[0.02] mono text-[13px] text-zinc-400 hover:text-white hover:bg-white/[0.04] hover:-translate-y-0.5 transition-all duration-300 cursor-default">
                        <span class="dot"></span>{{ $s }}
                    </span>
                @endforeach
            </div>

            {{-- actions --}}
            <div class="boot b6 flex flex-wrap gap-3">
                <a href="{{ route('projects.index') }}"
                   class="group inline-flex items-center gap-2.5 pl-6 pr-2 py-2 rounded-full bg-white text-black text-sm font-medium hover:bg-zinc-200 transition-colors">
                    {{ __('messages.home_view_projects') }}
                    <span class="w-8 h-8 rounded-full bg-black flex items-center justify-center">
                        <svg class="w-4 h-4 text-white group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </span>
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center px-6 py-3 rounded-full border border-white/15 text-sm text-zinc-200 hover:border-white/40 hover:bg-white/5 transition-colors">
                    {{ __('messages.home_get_in_touch') }}
                </a>
            </div>
        </div>

        {{-- hero stats with animated waves --}}
        <div class="relative max-w-7xl mx-auto px-6 w-full pb-14" style="z-index:2;">
            @php
                $stats = [
                    ['3+', __('messages.home_years_exp')],
                    ['10+', __('messages.home_apps_shipped')],
                    ['iOS & Android', __('messages.home_both_platforms')],
                ];
            @endphp
            <div class="grid grid-cols-3 gap-6 md:gap-12 pt-8 border-t border-white/10">
                @foreach($stats as $stat)
                    <div class="boot b6">
                        <p class="display text-white font-semibold {{ strlen($stat[0]) > 4 ? 'text-xl md:text-3xl' : 'text-3xl md:text-5xl' }}">{{ $stat[0] }}</p>
                        <svg class="wave block text-zinc-600 my-3" viewBox="0 0 240 24" width="100%" height="20" preserveAspectRatio="xMidYMid meet" data-w="240"></svg>
                        <p class="mono text-[11px] md:text-[12px] tracking-wide uppercase text-zinc-500">{{ $stat[1] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Featured projects ─────────────────────────────────────────── --}}
    <section class="relative max-w-7xl mx-auto px-6 py-28" style="z-index:2;">
        <div class="reveal-up flex items-end justify-between mb-14">
            <div>
                <div class="flex items-center gap-4 mb-4">
                    <span class="h-px w-12 bg-white/25"></span>
                    <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.home_work_label') }}</span>
                </div>
                <h2 class="display text-white font-semibold" style="font-size: clamp(2.2rem, 4.5vw, 3.6rem);">{{ __('messages.home_featured') }}</h2>
            </div>
            <a href="{{ route('projects.index') }}"
               class="group hidden sm:inline-flex items-center gap-2 mono text-sm text-zinc-500 hover:text-white transition-colors pb-2">
                {{ __('messages.home_view_all') }}
                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($featuredProjects as $project)
            <a href="{{ route('projects.show', $project->slug) }}"
               class="card reveal-up group relative rounded-3xl border border-white/[0.09] bg-white/[0.015]
                      hover:bg-white/[0.03] transition-all duration-500 overflow-hidden hover:-translate-y-1 {{ $loop->even ? 'rv-delay' : '' }}">

                @if($project->cover_image)
                    <div class="relative w-full h-48 overflow-hidden">
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
            @empty
            <div class="reveal-up rounded-3xl border border-dashed border-white/[0.09] p-14 flex items-center justify-center col-span-2">
                <p class="mono text-sm text-zinc-500">{{ __('messages.home_projects_soon') }}</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- ── CTA + inline chat ─────────────────────────────────────────── --}}
    <section class="relative border-t border-white/10" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 py-24">

            {{-- Default CTA --}}
            <div id="cta-default" class="reveal-up flex flex-col md:flex-row items-start md:items-center justify-between gap-10">
                <div class="max-w-xl">
                    <h2 class="display text-white font-semibold mb-4" style="font-size: clamp(2rem, 4vw, 3.2rem);">{{ __('messages.home_cta_title') }}</h2>
                    <p class="text-zinc-400 text-lg leading-relaxed">{{ __('messages.home_cta_sub') }}</p>
                </div>
                <button onclick="ctaOpenChat()"
                        class="group shrink-0 inline-flex items-center gap-2.5 pl-6 pr-2 py-2 rounded-full bg-white text-black text-sm font-medium hover:bg-zinc-200 transition-colors">
                    {{ __('messages.home_cta_btn') }}
                    <span class="w-8 h-8 rounded-full bg-black flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </span>
                </button>
            </div>

            {{-- Inline chat panel --}}
            <div id="cta-chat" class="hidden max-w-3xl mx-auto">
                <div class="rounded-3xl border border-white/[0.1] bg-white/[0.02] overflow-hidden backdrop-blur-sm">

                    <div class="flex items-center gap-3 px-5 py-4 border-b border-white/[0.08]">
                        <span class="w-9 h-9 rounded-full flex items-center justify-center shrink-0"
                              style="background: linear-gradient(135deg,#22d3ee,#818cf8,#c084fc);">
                            <svg class="w-4 h-4 text-black/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714a2.25 2.25 0 001.591 1.591L21 14.5"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-white">Cihan's Assistant</p>
                            <div class="flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span class="mono text-[11px] text-zinc-500">online</span>
                            </div>
                        </div>
                        <button onclick="ctaCloseChat()" class="ml-auto text-zinc-600 hover:text-white transition-colors p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div id="cta-messages" class="px-5 py-4 space-y-3 overflow-y-auto" style="min-height: 380px; max-height: 520px;">
                        <div class="flex gap-2.5">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 mt-0.5"
                                  style="background: linear-gradient(135deg,#22d3ee,#818cf8,#c084fc);">
                                <svg class="w-3 h-3 text-black/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5"/></svg>
                            </span>
                            <div class="max-w-[85%] rounded-2xl rounded-tl-md border border-white/[0.07] bg-white/[0.03] px-4 py-2.5">
                                <p class="text-[14px] text-zinc-300 leading-relaxed">{{ __('messages.home_chat_welcome') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 border-t border-white/[0.08]">
                        <div class="flex items-center gap-2">
                            <input id="cta-input" type="text"
                                   placeholder="{{ __('messages.home_chat_placeholder') }}"
                                   class="flex-1 px-4 py-2.5 rounded-full bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-white/25 transition-all">
                            <button id="cta-send"
                                    class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 transition-opacity hover:opacity-90 disabled:opacity-50"
                                    style="background: linear-gradient(135deg,#22d3ee,#818cf8,#c084fc);">
                                <svg class="w-4 h-4 text-black/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Admin shortcut (geliştirme kolaylığı - sonra kaldırılacak) --}}
    <div class="fixed bottom-6 right-6" style="z-index:50;">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full mono text-[12px] text-zinc-400
                  bg-white/[0.04] border border-white/[0.1] hover:text-white hover:border-white/30 transition-colors backdrop-blur-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Admin Panel
        </a>
    </div>

</div>

<script>
/* ── Animated dotted waves ──────────────────────────────────────────── */
(function () {
    const waves = Array.from(document.querySelectorAll('.wave'));
    if (!waves.length) return;
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const NS = 'http://www.w3.org/2000/svg';
    const DOTS = 30, H = 24;

    waves.forEach((svg, k) => {
        const W = parseFloat(svg.getAttribute('data-w')) || 240;
        svg.__phase = k * 1.3;
        for (let i = 0; i < DOTS; i++) {
            const dot = document.createElementNS(NS, 'circle');
            dot.setAttribute('cx', ((i / (DOTS - 1)) * W).toFixed(1));
            dot.setAttribute('cy', H / 2);
            dot.setAttribute('r', 1.5);
            dot.setAttribute('fill', 'currentColor');
            svg.appendChild(dot);
        }
    });

    function frame(t) {
        for (const svg of waves) {
            const dots = svg.childNodes;
            for (let i = 0; i < dots.length; i++) {
                const x = i / (dots.length - 1);
                const s = Math.sin(x * Math.PI * 4 + t / 720 + svg.__phase);
                dots[i].setAttribute('cy', (H / 2 + s * 5).toFixed(2));
                dots[i].setAttribute('opacity', (0.3 + 0.7 * (0.5 + 0.5 * s)).toFixed(2));
            }
        }
        requestAnimationFrame(frame);
    }
    if (!reduce) requestAnimationFrame(frame);
})();

/* ── Inline chat ────────────────────────────────────────────────────── */
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
            ? `<div class="max-w-[85%] rounded-2xl rounded-tr-md bg-white text-black px-4 py-2.5">
                 <p class="text-[14px] leading-relaxed">${ctaEscape(content)}</p>
               </div>`
            : `<span class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 mt-0.5" style="background:linear-gradient(135deg,#22d3ee,#818cf8,#c084fc)">
                 <svg class="w-3 h-3" style="color:rgba(0,0,0,.8)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5"/></svg>
               </span>
               <div class="max-w-[85%] rounded-2xl rounded-tl-md border border-white/[0.07] bg-white/[0.03] px-4 py-2.5">
                 <p class="text-[14px] leading-relaxed" style="color:#d4d4d8">${ctaEscape(content)}</p>
               </div>`;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
    }

    function ctaAddTyping() {
        const msgs = document.getElementById('cta-messages');
        const div = document.createElement('div');
        div.id = 'cta-typing';
        div.className = 'flex gap-2.5';
        div.innerHTML = `<span class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 mt-0.5" style="background:linear-gradient(135deg,#22d3ee,#818cf8,#c084fc)">
            <svg class="w-3 h-3" style="color:rgba(0,0,0,.8)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5"/></svg>
        </span>
        <div class="rounded-2xl rounded-tl-md border border-white/[0.07] bg-white/[0.03] px-4 py-3">
            <div class="flex gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 animate-bounce" style="animation-delay:0ms"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 animate-bounce" style="animation-delay:150ms"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 animate-bounce" style="animation-delay:300ms"></span>
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