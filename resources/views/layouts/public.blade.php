<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', __('messages.site_title'))</title>
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', Setting::get('meta_description', 'Flutter mobile developer specializing in clean architecture and scalable apps.'))">

    {{-- Fonts (centralized) --}}
    <link rel="preconnect" href="https://api.fontshare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://api.fontshare.com/v2/css?f[]=clash-display@500,600,700&f[]=general-sans@400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'General Sans', ui-sans-serif, system-ui, sans-serif; }
        .ff-display { font-family: 'Clash Display', 'General Sans', sans-serif; letter-spacing: -0.02em; }
        .ff-mono    { font-family: 'JetBrains Mono', ui-monospace, monospace; }
        ::selection { background: rgba(129,140,248,.35); }
        .brand-grad { background: linear-gradient(90deg,#22d3ee,#818cf8,#c084fc); -webkit-background-clip:text; background-clip:text; color:transparent; }

        /* ── Shared .lux design system (used by every page) ───────────── */
        .lux {
            --line: rgba(255,255,255,.09);
            position: relative; background:transparent; color:#f4f4f5;
            font-family: 'General Sans', ui-sans-serif, system-ui, sans-serif;
            overflow: clip;
        }
        .lux .display { font-family: 'Clash Display','General Sans',sans-serif; letter-spacing:-0.02em; }
        .lux .mono    { font-family: 'JetBrains Mono', ui-monospace, monospace; }

        @keyframes gradShift { 0% { background-position:0% 50% } 100% { background-position:200% 50% } }
        .lux .grad {
            background: linear-gradient(90deg,#22d3ee,#818cf8,#c084fc,#f472b6,#22d3ee);
            background-size:200% 100%;
            -webkit-background-clip:text; background-clip:text; color:transparent;
            animation: gradShift 9s linear infinite;
        }

        @keyframes drift1 { 0%,100% { transform:translate(0,0) scale(1) } 50% { transform:translate(-6%,5%) scale(1.15) } }
        @keyframes drift2 { 0%,100% { transform:translate(0,0) scale(1) } 50% { transform:translate(7%,-6%) scale(1.1) } }
        .lux .aurora { position:absolute; border-radius:9999px; filter:blur(120px); pointer-events:none; z-index:0; }

        .lux .grain {
            position:absolute; inset:0; pointer-events:none; z-index:1; opacity:.04;
            background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        @keyframes bootIn { from { opacity:0; transform:translateY(16px) } to { opacity:1; transform:translateY(0) } }
        .lux .boot { opacity:0; animation: bootIn .8s cubic-bezier(.2,.75,.2,1) forwards; }
        .b1{animation-delay:.05s}.b2{animation-delay:.15s}.b3{animation-delay:.28s}
        .b4{animation-delay:.42s}.b5{animation-delay:.56s}.b6{animation-delay:.7s}

        .lux .reveal-up { opacity:0; transform:translateY(26px);
            transition: opacity .8s cubic-bezier(.2,.75,.2,1), transform .8s cubic-bezier(.2,.75,.2,1); }
        .lux .reveal-up.in { opacity:1; transform:none; }
        .lux .rv-delay { transition-delay:.09s; }

        .lux .card { position:relative; }
        .lux .card::before {
            content:''; position:absolute; inset:0; border-radius:inherit; padding:1px; pointer-events:none;
            background: linear-gradient(130deg, rgba(34,211,238,.5), rgba(192,132,252,.4), rgba(244,114,182,.3));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude;
            opacity:0; transition: opacity .4s;
        }
        .lux .card:hover::before { opacity:1; }

        .lux .skill-chip { position:relative; }
        .lux .skill-chip::before {
            content:''; position:absolute; inset:0; border-radius:inherit; padding:1px; pointer-events:none;
            background: linear-gradient(120deg,#22d3ee,#818cf8,#c084fc,#f472b6);
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude;
            opacity:0; transition: opacity .35s;
        }
        .lux .skill-chip:hover::before { opacity:1; }
        .lux .skill-chip .dot {
            width:.375rem; height:.375rem; border-radius:9999px; background:#3f3f46; flex:none;
            animation: dotPulse 3.6s ease-in-out infinite;
        }
        @keyframes dotPulse {
            0%,20%,100% { background:#3f3f46; box-shadow:0 0 0 0 rgba(0,0,0,0); transform:scale(1); }
            9%          { background:var(--glow,#818cf8); box-shadow:0 0 10px 1px var(--glow,#818cf8); transform:scale(1.4); }
        }
        .lux .skill-chip:nth-child(4n+1) .dot { --glow:#22d3ee }
        .lux .skill-chip:nth-child(4n+2) .dot { --glow:#818cf8 }
        .lux .skill-chip:nth-child(4n+3) .dot { --glow:#c084fc }
        .lux .skill-chip:nth-child(4n)   .dot { --glow:#f472b6 }
        .lux .skill-chip:nth-child(1)  .dot { animation-delay:0s }
        .lux .skill-chip:nth-child(2)  .dot { animation-delay:.16s }
        .lux .skill-chip:nth-child(3)  .dot { animation-delay:.32s }
        .lux .skill-chip:nth-child(4)  .dot { animation-delay:.48s }
        .lux .skill-chip:nth-child(5)  .dot { animation-delay:.64s }
        .lux .skill-chip:nth-child(6)  .dot { animation-delay:.80s }
        .lux .skill-chip:nth-child(7)  .dot { animation-delay:.96s }
        .lux .skill-chip:nth-child(8)  .dot { animation-delay:1.12s }
        .lux .skill-chip:nth-child(9)  .dot { animation-delay:1.28s }
        .lux .skill-chip:nth-child(10) .dot { animation-delay:1.44s }
        .lux .skill-chip:nth-child(11) .dot { animation-delay:1.60s }
        .lux .skill-chip:nth-child(12) .dot { animation-delay:1.76s }
        .lux .skill-chip:nth-child(13) .dot { animation-delay:1.92s }
        .lux .skill-chip:nth-child(14) .dot { animation-delay:2.08s }
        .lux .skill-chip:nth-child(15) .dot { animation-delay:2.24s }
        .lux .skill-chip:nth-child(16) .dot { animation-delay:2.40s }

        /* timeline node */
        .lux .tl-line { position:absolute; top:1.6rem; bottom:-1.5rem; width:1px; background:rgba(255,255,255,.10); }
        .lux .tl-dot  { width:.85rem; height:.85rem; border-radius:9999px; background:#0a0a0a; border:2px solid rgba(255,255,255,.18); position:relative; z-index:1; }
        .lux .tl-dot.is-current { border-color:transparent; background:linear-gradient(135deg,#22d3ee,#818cf8,#c084fc); box-shadow:0 0 12px 1px rgba(129,140,248,.6); }

        /* timeline reveal choreography */
        .lux .tl > .reveal-up:nth-child(1){transition-delay:.02s}
        .lux .tl > .reveal-up:nth-child(2){transition-delay:.10s}
        .lux .tl > .reveal-up:nth-child(3){transition-delay:.18s}
        .lux .tl > .reveal-up:nth-child(4){transition-delay:.26s}
        .lux .tl > .reveal-up:nth-child(5){transition-delay:.34s}
        .lux .tl > .reveal-up:nth-child(6){transition-delay:.42s}
        .lux .tl > .reveal-up:nth-child(7){transition-delay:.50s}
        .lux .tl > .reveal-up:nth-child(8){transition-delay:.58s}
        .lux .reveal-up .tl-line { transform:scaleY(0); transform-origin:top; transition:transform .9s cubic-bezier(.2,.7,.2,1) .18s; }
        .lux .reveal-up.in .tl-line { transform:scaleY(1); }
        .lux .reveal-up .tl-dot { transform:scale(.35); opacity:0; transition:transform .55s cubic-bezier(.2,1.5,.45,1) .1s, opacity .4s .1s; }
        .lux .reveal-up.in .tl-dot { transform:scale(1); opacity:1; }
        .lux .tl-dot.is-current::after {
            content:''; position:absolute; inset:-4px; border-radius:9999px;
            border:1px solid rgba(129,140,248,.5); animation: ringPulse 2.2s ease-out infinite;
        }
        @keyframes ringPulse { 0% { transform:scale(.75); opacity:.75 } 100% { transform:scale(1.9); opacity:0 } }

        @media (prefers-reduced-motion: reduce) {
            .lux *, .lux *::before, .lux *::after { animation:none !important; }
            .lux .boot { opacity:1 !important; transform:none !important; }
            .lux .reveal-up { opacity:1 !important; transform:none !important; }
            .lux .tl-line, .lux .tl-dot { transform:none !important; opacity:1 !important; }
        }

        /* ── Mobile performance: drop the expensive compositing layers ── */
        @media (max-width: 767px) {
            .nav-pill, #nav-menu {
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                background: rgba(0,0,0,.92) !important;
            }
            .lux .aurora { display: none !important; }   /* big blur() layers */
            .lux .grain  { display: none !important; }   /* full-page overlay */
            .lux .skill-chip .dot { animation: none !important; }  /* box-shadow repaint */
            .lux .grad { animation: none !important; }   /* gradient-text repaint */
        }
    </style>
</head>
<body id="top" class="bg-black text-zinc-100 antialiased">

    {{-- Global particle field (fixed, behind everything, every page) --}}
    <canvas id="hero-canvas" class="fixed inset-0 w-full h-full pointer-events-none" style="z-index:-1;"></canvas>

    {{-- ── Floating pill navbar ──────────────────────────────────────── --}}
    <header class="fixed top-0 inset-x-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-4">
            <div class="nav-pill flex items-center justify-between gap-4 h-14 pl-5 pr-2.5 rounded-full border border-white/10 bg-black/60 backdrop-blur-xl shadow-[0_8px_40px_-16px_rgba(0,0,0,.9)]">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="ff-display text-lg font-semibold tracking-tight leading-none shrink-0">
                    <span class="text-white">Cihan</span><span class="brand-grad">Ören</span>
                </a>

                {{-- Center nav --}}
                <nav class="hidden md:flex items-center gap-7 text-sm">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-white' : 'text-zinc-400 hover:text-white' }} transition-colors">{{ __('messages.nav_home') }}</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-white' : 'text-zinc-400 hover:text-white' }} transition-colors">{{ __('messages.nav_about') }}</a>
                    <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'text-white' : 'text-zinc-400 hover:text-white' }} transition-colors">{{ __('messages.nav_projects') }}</a>
                    <a href="{{ route('resume') }}" class="{{ request()->routeIs('resume') ? 'text-white' : 'text-zinc-400 hover:text-white' }} transition-colors">{{ __('messages.nav_resume') }}</a>
                </nav>

                {{-- Right cluster --}}
                <div class="flex items-center gap-2 shrink-0">
                    {{-- Language toggle --}}
                    <div class="hidden sm:flex items-center gap-0.5 ff-mono text-[11px] p-0.5 rounded-full border border-white/10">
                        <a href="{{ route('lang.switch', 'tr') }}"
                           class="px-2.5 py-1 rounded-full transition-colors {{ app()->getLocale() === 'tr' ? 'bg-white text-black' : 'text-zinc-500 hover:text-white' }}">TR</a>
                        <a href="{{ route('lang.switch', 'en') }}"
                           class="px-2.5 py-1 rounded-full transition-colors {{ app()->getLocale() === 'en' ? 'bg-white text-black' : 'text-zinc-500 hover:text-white' }}">EN</a>
                    </div>

                    {{-- Hire / contact --}}
                    <a href="{{ route('contact') }}"
                       class="hidden md:inline-flex items-center px-4 py-2 rounded-full bg-white text-black text-sm font-medium hover:bg-zinc-200 transition-colors">
                        {{ __('messages.nav_hire') }}
                    </a>

                    {{-- Mobile toggle --}}
                    <button id="nav-toggle" aria-label="Menu" class="md:hidden w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-zinc-300 hover:text-white transition-colors">
                        <svg id="nav-icon-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="nav-icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile menu --}}
            <div id="nav-menu" class="md:hidden hidden mt-2 rounded-3xl border border-white/10 bg-black/90 backdrop-blur-xl p-2 overflow-hidden">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-2xl text-[15px] {{ request()->routeIs('home') ? 'text-white bg-white/5' : 'text-zinc-400 hover:text-white hover:bg-white/5' }} transition-colors">{{ __('messages.nav_home') }}</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-2xl text-[15px] {{ request()->routeIs('about') ? 'text-white bg-white/5' : 'text-zinc-400 hover:text-white hover:bg-white/5' }} transition-colors">{{ __('messages.nav_about') }}</a>
                <a href="{{ route('projects.index') }}" class="block px-4 py-3 rounded-2xl text-[15px] {{ request()->routeIs('projects.*') ? 'text-white bg-white/5' : 'text-zinc-400 hover:text-white hover:bg-white/5' }} transition-colors">{{ __('messages.nav_projects') }}</a>
                <a href="{{ route('resume') }}" class="block px-4 py-3 rounded-2xl text-[15px] {{ request()->routeIs('resume') ? 'text-white bg-white/5' : 'text-zinc-400 hover:text-white hover:bg-white/5' }} transition-colors">{{ __('messages.nav_resume') }}</a>

                <div class="flex items-center gap-3 px-4 py-3 mt-1 border-t border-white/[0.07]">
                    <div class="flex items-center gap-0.5 ff-mono text-[11px] p-0.5 rounded-full border border-white/10">
                        <a href="{{ route('lang.switch', 'tr') }}" class="px-2.5 py-1 rounded-full {{ app()->getLocale() === 'tr' ? 'bg-white text-black' : 'text-zinc-500' }}">TR</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="px-2.5 py-1 rounded-full {{ app()->getLocale() === 'en' ? 'bg-white text-black' : 'text-zinc-500' }}">EN</a>
                    </div>
                    <a href="{{ route('contact') }}" class="ml-auto inline-flex items-center px-4 py-2 rounded-full bg-white text-black text-sm font-medium">{{ __('messages.nav_hire') }}</a>
                </div>
            </div>
        </div>
    </header>

    {{-- Page content --}}
    <main class="pt-20">
        @yield('content')
    </main>

    {{-- ── Footer ────────────────────────────────────────────────────── --}}
    <footer class="relative border-t border-white/10 bg-black">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid gap-10 md:grid-cols-[1.6fr_1fr_1fr]">

                {{-- Brand --}}
                <div>
                    <a href="{{ route('home') }}" class="ff-display text-2xl font-semibold tracking-tight">
                        <span class="text-white">Cihan</span><span class="brand-grad">Ören</span>
                    </a>
                    <a href="mailto:{{ Setting::get('contact_email', 'cihan@cihanoren.com') }}"
                       class="mt-4 block ff-mono text-sm text-zinc-500 hover:text-white transition-colors w-fit">
                        {{ Setting::get('contact_email', 'cihan@cihanoren.com') }}
                    </a>
                </div>

                {{-- Nav --}}
                <div class="flex flex-col gap-3 text-sm">
                    <span class="h-px w-8 bg-white/15 mb-1"></span>
                    <a href="{{ route('home') }}" class="text-zinc-400 hover:text-white transition-colors w-fit">{{ __('messages.nav_home') }}</a>
                    <a href="{{ route('about') }}" class="text-zinc-400 hover:text-white transition-colors w-fit">{{ __('messages.nav_about') }}</a>
                    <a href="{{ route('projects.index') }}" class="text-zinc-400 hover:text-white transition-colors w-fit">{{ __('messages.nav_projects') }}</a>
                    <a href="{{ route('resume') }}" class="text-zinc-400 hover:text-white transition-colors w-fit">{{ __('messages.nav_resume') }}</a>
                </div>

                {{-- Social --}}
                <div class="flex flex-col gap-3 text-sm">
                    <span class="h-px w-8 bg-white/15 mb-1"></span>
                    <a href="{{ Setting::get('github_url', 'https://github.com/cihanoren') }}" target="_blank" rel="noopener"
                       class="group inline-flex items-center gap-2 text-zinc-400 hover:text-white transition-colors w-fit">
                        GitHub
                        <svg class="w-3.5 h-3.5 opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                    </a>
                    <a href="{{ Setting::get('linkedin_url', 'https://linkedin.com/in/cihanoren') }}" target="_blank" rel="noopener"
                       class="group inline-flex items-center gap-2 text-zinc-400 hover:text-white transition-colors w-fit">
                        LinkedIn
                        <svg class="w-3.5 h-3.5 opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7v10"/></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="text-zinc-400 hover:text-white transition-colors w-fit">{{ __('messages.nav_hire') }}</a>
                </div>
            </div>

            <div class="mt-14 pt-6 border-t border-white/[0.07] flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="ff-mono text-xs text-zinc-600">© {{ date('Y') }} CihanÖren · {{ __('messages.footer_rights') }}</span>
                <button onclick="window.scrollTo({top:0,behavior:'smooth'})"
                        class="group inline-flex items-center gap-2 ff-mono text-xs text-zinc-500 hover:text-white transition-colors">
                    top
                    <span class="w-6 h-6 rounded-full border border-white/10 flex items-center justify-center group-hover:border-white/30 transition-colors">
                        <svg class="w-3 h-3 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                    </span>
                </button>
            </div>
        </div>
    </footer>

    <script>
        /* Global scroll reveal for any .reveal-up element */
        (function () {
            const els = Array.from(document.querySelectorAll('.reveal-up'));
            if (!els.length) return;
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                els.forEach(e => e.classList.add('in')); return;
            }
            const io = new IntersectionObserver((entries) => {
                entries.forEach(en => {
                    if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
            els.forEach(e => io.observe(e));
        })();

        /* Global particle field — animated on desktop/Android, STATIC on iOS/WebKit */
        (function () {
            const c = document.getElementById('hero-canvas');
            if (!c) return;
            const ctx = c.getContext('2d');
            const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const coarse = window.matchMedia('(pointer: coarse)').matches;
            // iOS (iPhone/iPad/iPod, incl. iPadOS masquerading as Mac) — WebKit composites a
            // fixed, continuously-repainting canvas very poorly, so we render it once (static).
            const iOS = /iP(hone|od|ad)/.test(navigator.userAgent) ||
                        (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
            const STATIC = reduce || iOS;
            let w = 0, h = 0, dpr = 1, lastW = -1, nodes = [], raf = null, mobile = false, paused = false;
            const mouse = { x: -9999, y: -9999 };

            function isMobile() { return window.matchMedia('(max-width: 767px)').matches; }
            function count() { return mobile ? 20 : 60; }
            function resize() {
                mobile = isMobile();
                dpr = mobile ? 1 : Math.min(window.devicePixelRatio || 1, 2);
                w = c.clientWidth; h = c.clientHeight;
                c.width = w * dpr; c.height = h * dpr;
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            }
            function seed() {
                nodes = [];
                const n = count();
                for (let i = 0; i < n; i++) {
                    nodes.push({
                        x: Math.random() * w, y: Math.random() * h,
                        vx: (Math.random() - .5) * .22, vy: (Math.random() - .5) * .22,
                        r: Math.random() * 1.5 + .5
                    });
                }
            }
            function mix(a, b, t) { return [a[0]+(b[0]-a[0])*t, a[1]+(b[1]-a[1])*t, a[2]+(b[2]-a[2])*t]; }
            const cyan = [34, 211, 238], pink = [244, 114, 182];
            function render() {
                ctx.clearRect(0, 0, w, h);
                for (const n of nodes) {
                    const col = mix(cyan, pink, Math.min(1, n.x / w));
                    const bright = 0.25 + 0.6 * (n.x / w);
                    ctx.beginPath();
                    ctx.arc(n.x, n.y, n.r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(${col[0]|0},${col[1]|0},${col[2]|0},${bright.toFixed(2)})`;
                    ctx.fill();
                }
                if (!mobile && !STATIC) {
                    for (let i = 0; i < nodes.length; i++) {
                        for (let j = i + 1; j < nodes.length; j++) {
                            const a = nodes[i], b = nodes[j];
                            const dx = a.x - b.x, dy = a.y - b.y;
                            const d = Math.hypot(dx, dy);
                            if (d < 128) {
                                ctx.strokeStyle = `rgba(150,160,220,${((1 - d / 128) * 0.16).toFixed(3)})`;
                                ctx.lineWidth = .6;
                                ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke();
                            }
                        }
                        const mx = nodes[i].x - mouse.x, my = nodes[i].y - mouse.y;
                        const md = Math.hypot(mx, my);
                        if (md < 150) {
                            ctx.strokeStyle = `rgba(129,140,248,${((1 - md / 150) * 0.4).toFixed(3)})`;
                            ctx.lineWidth = .7;
                            ctx.beginPath(); ctx.moveTo(nodes[i].x, nodes[i].y); ctx.lineTo(mouse.x, mouse.y); ctx.stroke();
                        }
                    }
                }
            }
            function tick() {
                for (const n of nodes) {
                    n.x += n.vx; n.y += n.vy;
                    if (n.x < 0 || n.x > w) n.vx *= -1;
                    if (n.y < 0 || n.y > h) n.vy *= -1;
                }
                render();
                raf = requestAnimationFrame(tick);
            }
            function start() { if (!raf && !paused && !STATIC) tick(); }
            function stop() { if (raf) { cancelAnimationFrame(raf); raf = null; } }

            resize(); lastW = window.innerWidth; seed();
            if (STATIC) render(); else start();

            let rt;
            window.addEventListener('resize', function () {
                // iOS toggles the URL bar -> height-only resize; ignore to avoid canvas thrash
                if (window.innerWidth === lastW) return;
                lastW = window.innerWidth;
                clearTimeout(rt);
                rt = setTimeout(function () { resize(); seed(); if (STATIC) render(); }, 150);
            });
            document.addEventListener('visibilitychange', function () {
                paused = document.hidden;
                if (paused) stop(); else start();
            });
            if (!coarse) {
                c.addEventListener('pointermove', function (e) {
                    const rect = c.getBoundingClientRect();
                    mouse.x = e.clientX - rect.left; mouse.y = e.clientY - rect.top;
                });
                c.addEventListener('pointerleave', function () { mouse.x = -9999; mouse.y = -9999; });
            }
        })();

        (function () {
            const btn = document.getElementById('nav-toggle');
            const menu = document.getElementById('nav-menu');
            const iOpen = document.getElementById('nav-icon-open');
            const iClose = document.getElementById('nav-icon-close');
            if (!btn || !menu) return;
            btn.addEventListener('click', function () {
                const open = menu.classList.toggle('hidden') === false;
                iOpen.classList.toggle('hidden', open);
                iClose.classList.toggle('hidden', !open);
            });
            menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
                menu.classList.add('hidden');
                iOpen.classList.remove('hidden');
                iClose.classList.add('hidden');
            }));
        })();
    </script>
</body>
</html>