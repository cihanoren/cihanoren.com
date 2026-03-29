@extends('layouts.public')

@section('title', 'Contact — CihanÖren')

@section('content')

<section class="relative overflow-hidden">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-20 -right-20 w-[500px] h-[500px] rounded-full bg-indigo-600/8 blur-[100px]"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 pt-24 pb-32">

        {{-- Header --}}
        <div class="mb-16">
            <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-4">Contact</p>
            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-4">
                Let's work together.
            </h1>
            <p class="text-gray-400 text-lg max-w-md">
                Available for freelance projects and full-time opportunities.
            </p>
        </div>

        <div class="grid md:grid-cols-[1fr_400px] gap-12 items-start">

            {{-- Form --}}
            <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-8">

                @if(session('success'))
                    <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5" id="contact-form">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all"
                               placeholder="Your name">
                        @error('name') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all"
                               placeholder="your@email.com">
                        @error('email') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Message</label>
                        <textarea name="message" rows="5"
                                  class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all resize-none"
                                  placeholder="Tell me about your project...">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" id="submit-btn"
                            class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-600/20 disabled:opacity-60 disabled:cursor-not-allowed">
                        <span id="btn-text" class="inline-flex items-center gap-2">
                            Send Message
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </span>
                        <span id="btn-loading" class="hidden inline-flex items-center gap-2">
                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Sending...
                        </span>
                    </button>
                </form>
            </div>

            {{-- Sağ: Linkler --}}
            <div class="space-y-4 md:pt-2">
                <a href="mailto:cihan@cihanoren.com"
                   class="group flex items-center gap-4 p-5 rounded-2xl border border-white/[0.08] bg-white/[0.02] hover:border-indigo-500/40 hover:bg-white/[0.04] transition-all duration-200">
                    <div class="w-11 h-11 rounded-xl bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-0.5">Email</p>
                        <p class="text-white text-sm font-semibold group-hover:text-indigo-400 transition-colors">cihan@cihanoren.com</p>
                    </div>
                </a>

                <a href="https://github.com/cihanoren" target="_blank"
                   class="group flex items-center gap-4 p-5 rounded-2xl border border-white/[0.08] bg-white/[0.02] hover:border-indigo-500/40 hover:bg-white/[0.04] transition-all duration-200">
                    <div class="w-11 h-11 rounded-xl bg-white/[0.05] border border-white/[0.1] flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-0.5">GitHub</p>
                        <p class="text-white text-sm font-semibold group-hover:text-indigo-400 transition-colors">github.com/cihanoren</p>
                    </div>
                </a>

                <a href="https://linkedin.com/in/cihanoren" target="_blank"
                   class="group flex items-center gap-4 p-5 rounded-2xl border border-white/[0.08] bg-white/[0.02] hover:border-indigo-500/40 hover:bg-white/[0.04] transition-all duration-200">
                    <div class="w-11 h-11 rounded-xl bg-blue-500/15 border border-blue-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium mb-0.5">LinkedIn</p>
                        <p class="text-white text-sm font-semibold group-hover:text-indigo-400 transition-colors">linkedin.com/in/cihanoren</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

<script>
document.getElementById('contact-form').addEventListener('submit', function() {
    const btn = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');
    const btnLoading = document.getElementById('btn-loading');
    btn.disabled = true;
    btnText.classList.add('hidden');
    btnLoading.classList.remove('hidden');
});
</script>

@endsection