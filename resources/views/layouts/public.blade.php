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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 font-sans antialiased">
    {{-- Navbar --}}
    <header class="fixed top-0 inset-x-0 z-50 border-b border-white/5 bg-gray-950/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-baseline gap-2 leading-none">
                <span class="text-white font-black text-xl tracking-tight">Cihan</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400 font-black text-xl tracking-tight">Ören</span>
            </a>
            <nav class="hidden md:flex items-center gap-8 text-sm text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('messages.nav_home') }}</a>
                <a href="{{ route('about') }}" class="hover:text-white transition-colors">{{ __('messages.nav_about') }}</a>
                <a href="{{ route('projects.index') }}" class="hover:text-white transition-colors">{{ __('messages.nav_projects') }}</a>
                <a href="{{ route('resume') }}" class="hover:text-white transition-colors">{{ __('messages.nav_resume') }}</a>

                {{-- Dil toggle --}}
                <div class="flex items-center gap-1 bg-white/[0.04] border border-white/[0.08] rounded-lg px-1 py-1">
                    <a href="{{ route('lang.switch', 'tr') }}"
                       class="px-2.5 py-1 rounded-md text-xs font-semibold transition-all {{ app()->getLocale() === 'tr' ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-white' }}">
                        TR
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-2.5 py-1 rounded-md text-xs font-semibold transition-all {{ app()->getLocale() === 'en' ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-white' }}">
                        EN
                    </a>
                </div>

                <a href="{{ route('contact') }}" class="px-4 py-1.5 rounded-full border border-indigo-500 text-indigo-400 hover:bg-indigo-500 hover:text-white transition-all">
                    {{ __('messages.nav_hire') }}
                </a>
            </nav>
            {{-- Mobile menu button --}}
            <button class="md:hidden text-gray-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </header>
    {{-- Page content --}}
    <main class="pt-16">
        @yield('content')
    </main>
    {{-- Footer --}}
    <footer class="border-t border-white/5 mt-32">
        <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-500">
            <span>© {{ date('Y') }} CihanÖren. {{ __('messages.footer_rights') }}</span>
            <div class="flex items-center gap-5">
                <a href="{{ Setting::get('github_url', 'https://github.com/cihanoren') }}" target="_blank" class="hover:text-white transition-colors">GitHub</a>
                <a href="{{ Setting::get('linkedin_url', 'https://linkedin.com/in/cihanoren') }}" target="_blank" class="hover:text-white transition-colors">LinkedIn</a>
                <a href="{{ route('contact') }}" class="hover:text-white transition-colors">{{ __('messages.nav_hire') }}</a>
            </div>
        </div>
    </footer>
</body>
</html>