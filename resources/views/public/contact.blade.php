@extends('layouts.public')

@section('title', __('messages.contact_label') . ' — CihanÖren')

@section('content')

{{-- favicon fallback --}}
<script>(function(){var l=document.querySelector("link[rel~='icon']");if(!l){l=document.createElement('link');document.head.appendChild(l);}l.rel='icon';l.type='image/png';l.href='/favicon.png';})();</script>

{{-- reCAPTCHA v3 --}}
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

<div class="lux -mt-20">

    {{-- ambient --}}
    <div class="aurora" style="top:-8%; right:-8%; width:48vw; height:48vw; max-width:740px; max-height:740px;
         background: radial-gradient(circle at 50% 50%, rgba(129,140,248,.16), transparent 62%); animation: drift1 22s ease-in-out infinite;"></div>
    <div class="grain"></div>

    {{-- ── Hero band ─────────────────────────────────────────────────── --}}
    <section class="relative" style="z-index:2;">
        <div class="relative max-w-7xl mx-auto px-6 pt-28 pb-8" style="z-index:2;">
            <div class="boot b1 flex items-center gap-4 mb-8">
                <span class="h-px w-12 bg-white/25"></span>
                <span class="mono text-[12px] tracking-[0.18em] uppercase text-zinc-400">{{ __('messages.contact_label') }}</span>
            </div>
            <h1 class="boot b2 display font-semibold text-white leading-[0.98] mb-5 max-w-3xl"
                style="font-size: clamp(2.6rem, 6.5vw, 5rem);">
                {{ __('messages.contact_title') }}
            </h1>
            <p class="boot b3 text-zinc-400 text-lg max-w-md leading-relaxed">{{ __('messages.contact_sub') }}</p>
        </div>
    </section>

    {{-- ── Body ──────────────────────────────────────────────────────── --}}
    <section class="relative" style="z-index:2;">
        <div class="max-w-7xl mx-auto px-6 pb-32 pt-6">
            <div class="grid md:grid-cols-[1fr_400px] gap-6 items-start">

                {{-- Form --}}
                <div class="card reveal-up rounded-3xl border border-white/[0.09] bg-white/[0.02] p-8">

                    @if(session('success'))
                        <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @error('recaptcha_token')
                        <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5" id="contact-form">
                        @csrf
                        <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                        <div>
                            <label class="block mono text-[11px] font-medium text-zinc-400 uppercase tracking-wide mb-2">{{ __('messages.contact_name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-white/30 focus:bg-white/[0.06] transition-all"
                                   placeholder="{{ __('messages.contact_name_ph') }}">
                            @error('name') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mono text-[11px] font-medium text-zinc-400 uppercase tracking-wide mb-2">{{ __('messages.contact_email') }}</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-white/30 focus:bg-white/[0.06] transition-all"
                                   placeholder="{{ __('messages.contact_email_ph') }}">
                            @error('email') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mono text-[11px] font-medium text-zinc-400 uppercase tracking-wide mb-2">{{ __('messages.contact_message') }}</label>
                            <textarea name="message" rows="5"
                                      class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-white/30 focus:bg-white/[0.06] transition-all resize-none"
                                      placeholder="{{ __('messages.contact_msg_ph') }}">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" id="submit-btn"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full bg-white text-black font-medium text-sm hover:bg-zinc-200 transition-colors disabled:opacity-60 disabled:cursor-not-allowed">
                            <span id="btn-text" class="inline-flex items-center gap-2">
                                {{ __('messages.contact_send') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </span>
                            <span id="btn-loading" class="hidden inline-flex items-center gap-2">
                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                {{ __('messages.contact_sending') }}
                            </span>
                        </button>

                        <p class="text-[11px] text-zinc-600 text-center leading-relaxed">
                            This site is protected by reCAPTCHA and the Google
                            <a href="https://policies.google.com/privacy" target="_blank" rel="noopener" class="underline hover:text-zinc-400">Privacy Policy</a> and
                            <a href="https://policies.google.com/terms" target="_blank" rel="noopener" class="underline hover:text-zinc-400">Terms of Service</a> apply.
                        </p>
                    </form>
                </div>

                {{-- Links --}}
                <div class="space-y-3">
                    <a href="mailto:{{ Setting::get('contact_email', 'cihan@cihanoren.com') }}"
                       class="card reveal-up group flex items-center gap-4 p-5 rounded-3xl border border-white/[0.09] bg-white/[0.02] hover:bg-white/[0.04] transition-colors duration-300">
                        <span class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0" style="background:rgba(34,211,238,.14)">
                            <svg class="w-5 h-5" style="color:#22d3ee" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="mono text-[11px] text-zinc-500 uppercase tracking-wide mb-0.5">Email</p>
                            <p class="text-white text-sm font-medium group-hover:text-cyan-300 transition-colors">{{ Setting::get('contact_email', 'cihan@cihanoren.com') }}</p>
                        </div>
                    </a>

                    <a href="{{ Setting::get('github_url', 'https://github.com/cihanoren') }}" target="_blank" rel="noopener"
                       class="card reveal-up group flex items-center gap-4 p-5 rounded-3xl border border-white/[0.09] bg-white/[0.02] hover:bg-white/[0.04] transition-colors duration-300">
                        <span class="w-11 h-11 rounded-2xl bg-white/[0.06] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-zinc-200" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="mono text-[11px] text-zinc-500 uppercase tracking-wide mb-0.5">GitHub</p>
                            <p class="text-white text-sm font-medium group-hover:text-white transition-colors">github.com/cihanoren</p>
                        </div>
                    </a>

                    <a href="{{ Setting::get('linkedin_url', 'https://linkedin.com/in/cihanoren') }}" target="_blank" rel="noopener"
                       class="card reveal-up group flex items-center gap-4 p-5 rounded-3xl border border-white/[0.09] bg-white/[0.02] hover:bg-white/[0.04] transition-colors duration-300">
                        <span class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0" style="background:rgba(56,189,248,.14)">
                            <svg class="w-5 h-5" style="color:#38bdf8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="mono text-[11px] text-zinc-500 uppercase tracking-wide mb-0.5">LinkedIn</p>
                            <p class="text-white text-sm font-medium group-hover:text-sky-300 transition-colors">linkedin.com/in/cihanoren</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

</div>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    // Token zaten alınmışsa (recursive submit sırasında) bırak geçsin.
    if (document.getElementById('recaptcha_token').value) {
        return;
    }

    e.preventDefault();

    const btn = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');
    const btnLoading = document.getElementById('btn-loading');
    btn.disabled = true;
    btnText.classList.add('hidden');
    btnLoading.classList.remove('hidden');

    grecaptcha.ready(function() {
        grecaptcha.execute('{{ config("services.recaptcha.site_key") }}', {action: 'contact'})
            .then(function(token) {
                document.getElementById('recaptcha_token').value = token;
                document.getElementById('contact-form').submit(); // native submit, event tekrar tetiklenmez
            })
            .catch(function() {
                btn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
                alert('Doğrulama başlatılamadı, lütfen sayfayı yenileyip tekrar deneyin.');
            });
    });
});
</script>

@endsection