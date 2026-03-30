<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin') — CihanÖren</title>
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/favicon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 font-sans antialiased">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="fixed top-0 left-0 h-full w-60 bg-gray-900 border-r border-white/[0.06] flex flex-col z-40">

        {{-- Logo --}}
        <div class="px-6 py-5 border-b border-white/[0.06]">
            <a href="{{ route('home') }}" class="inline-flex items-baseline gap-1.5">
                <span class="text-white font-black text-lg tracking-tight">Cihan</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400 font-black text-lg tracking-tight">Ören</span>
            </a>
            <p class="text-[10px] text-gray-600 mt-0.5 uppercase tracking-widest font-medium">Admin Panel</p>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

            <p class="text-[10px] font-semibold text-gray-600 uppercase tracking-widest px-3 mb-2 mt-1">Main</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/15 text-indigo-400 border border-indigo-500/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.05]' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.projects.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-indigo-500/15 text-indigo-400 border border-indigo-500/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.05]' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                Projects
            </a>

            <a href="{{ route('admin.chat.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.chat.*') ? 'bg-indigo-500/15 text-indigo-400 border border-indigo-500/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.05]' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Chat Logs
            </a>

            <a href="{{ route('admin.messages.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-indigo-500/15 text-indigo-400 border border-indigo-500/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.05]' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Messages
            </a>

            <p class="text-[10px] font-semibold text-gray-600 uppercase tracking-widest px-3 mb-2 mt-4">Content</p>

            <a href="{{ route('admin.experience.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.experience.*') ? 'bg-indigo-500/15 text-indigo-400 border border-indigo-500/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.05]' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Experience
            </a>

            <a href="{{ route('admin.education.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.education.*') ? 'bg-indigo-500/15 text-indigo-400 border border-indigo-500/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.05]' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0H9m3 0h3"/>
                </svg>
                Education
            </a>

            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-500/15 text-indigo-400 border border-indigo-500/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.05]' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>

        </nav>

        {{-- User + Logout --}}
        <div class="px-3 py-4 border-t border-white/[0.06]">
            <div class="flex items-center gap-3 px-3 py-2 mb-1">
                <div class="w-8 h-8 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0">
                    <span class="text-indigo-400 text-xs font-black">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-500 hover:text-red-400 hover:bg-red-500/[0.05] transition-colors">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign out
                </button>
            </form>
        </div>

    </aside>

    {{-- Main content --}}
    <div class="flex-1 ml-60 flex flex-col min-h-screen">

        {{-- Top bar --}}
        <header class="sticky top-0 z-30 border-b border-white/[0.06] bg-gray-950/80 backdrop-blur-sm">
            <div class="px-8 h-14 flex items-center justify-between">
                <h1 class="text-sm font-semibold text-white">@yield('page-title', 'Dashboard')</h1>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank"
                       class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-white transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View site
                    </a>
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mx-8 mt-5">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- Page content --}}
        <main class="flex-1 px-8 py-8">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>