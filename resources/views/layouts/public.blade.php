<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'CihanÖren — Flutter Developer')</title>
    <meta name="description" content="@yield('description', 'Flutter mobile developer specializing in clean architecture and scalable apps.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 font-sans antialiased">

    {{-- Navbar --}}
    <header class="fixed top-0 inset-x-0 z-50 border-b border-white/5 bg-gray-950/80 backdrop-blur-sm">
        <div class="max-w-5xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-white font-semibold tracking-tight text-lg">
                CihanÖren
            </a>
            <nav class="hidden md:flex items-center gap-8 text-sm text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <a href="{{ route('about') }}" class="hover:text-white transition-colors">About</a>
                <a href="{{ route('projects.index') }}" class="hover:text-white transition-colors">Projects</a>
                <a href="{{ route('resume') }}" class="hover:text-white transition-colors">Resume</a>
                <a href="{{ route('contact') }}" class="px-4 py-1.5 rounded-full border border-indigo-500 text-indigo-400 hover:bg-indigo-500 hover:text-white transition-all">
                    Hire Me
                </a>
            </nav>
            {{-- Mobile menu button (ileride eklenecek) --}}
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
        <div class="max-w-5xl mx-auto px-6 py-10 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-500">
            <span>© {{ date('Y') }} CihanÖren. All rights reserved.</span>
            <div class="flex items-center gap-5">
                <a href="https://github.com/cihanoren" target="_blank" class="hover:text-white transition-colors">GitHub</a>
                <a href="https://linkedin.com/in/cihanoren" target="_blank" class="hover:text-white transition-colors">LinkedIn</a>
                <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>