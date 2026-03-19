<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Two-Factor Auth — CihanÖren</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 font-sans antialiased min-h-screen flex items-center justify-center">

    {{-- Background glow --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-32 -left-32 w-[500px] h-[500px] rounded-full bg-indigo-600/8 blur-[120px]"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] rounded-full bg-violet-600/6 blur-[100px]"></div>
        <div class="absolute inset-0 opacity-[0.02]" style="background-image: linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px); background-size: 48px 48px;"></div>
    </div>

    <div class="relative w-full max-w-sm mx-auto px-6 py-12">

        {{-- Logo --}}
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-flex items-baseline gap-2">
                <span class="text-white font-black text-4xl tracking-tight">Cihan</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400 font-black text-4xl tracking-tight">Ören</span>
            </a>
        </div>

        {{-- Card --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-8">

            {{-- Icon --}}
            <div class="flex justify-center mb-6">
                <div class="w-14 h-14 rounded-2xl bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-xl font-black text-white mb-2">Two-Factor Authentication</h1>
                <p class="text-sm text-gray-500">Enter the 6-digit code from your authenticator app.</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.2fa.verify') }}" class="space-y-5">
                @csrf

                <div>
                    <input type="text" name="code" maxlength="6" autofocus
                           inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code"
                           class="w-full px-4 py-4 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-center text-3xl font-mono tracking-[0.6em] placeholder-gray-700 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('code') border-red-500/50 @enderror"
                           placeholder="000000">
                </div>

                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-600/20">
                    Verify
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- Logout --}}
        <div class="text-center mt-6">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs text-gray-600 hover:text-gray-400 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign out
                </button>
            </form>
        </div>

    </div>
</body>
</html>