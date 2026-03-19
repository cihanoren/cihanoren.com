<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setup 2FA — CihanÖren</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 font-sans antialiased min-h-screen flex items-center justify-center">

    {{-- Background glow --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-32 -left-32 w-[500px] h-[500px] rounded-full bg-indigo-600/8 blur-[120px]"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] rounded-full bg-violet-600/6 blur-[100px]"></div>
        <div class="absolute inset-0 opacity-[0.02]" style="background-image: linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px); background-size: 48px 48px;"></div>
    </div>

    <div class="relative w-full max-w-md mx-auto px-6 py-12">

        {{-- Logo --}}
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-flex items-baseline gap-2">
                <span class="text-white font-black text-4xl tracking-tight">Cihan</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400 font-black text-4xl tracking-tight">Ören</span>
            </a>
        </div>

        {{-- Card --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-8">

            <div class="mb-8">
                <h1 class="text-xl font-black text-white mb-2">Setup Two-Factor Auth</h1>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Scan the QR code below with your authenticator app (Google Authenticator, Authy, etc.), then enter the 6-digit code to activate.
                </p>
            </div>

            {{-- QR Code --}}
            <div class="flex justify-center mb-6">
                <div class="p-4 bg-white rounded-2xl">
                    {!! $qrCodeSvg !!}
                </div>
            </div>

            {{-- Manual key --}}
            <div class="mb-8">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Manual entry key</p>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08]">
                    <code class="text-sm text-indigo-400 font-mono tracking-widest flex-1 break-all">{{ $secret }}</code>
                    <button onclick="navigator.clipboard.writeText('{{ $secret }}')"
                            class="shrink-0 text-gray-600 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Verify form --}}
            <form method="POST" action="{{ route('admin.2fa.enable') }}" class="space-y-5">
                @csrf

                @if ($errors->any())
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                        Verification Code
                    </label>
                    <input type="text" name="code" maxlength="6" autofocus
                           inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code"
                           class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-center text-2xl font-mono tracking-[0.5em] placeholder-gray-700 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('code') border-red-500/50 @enderror"
                           placeholder="000000">
                </div>

                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-600/20">
                    Activate 2FA
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</body>
</html>