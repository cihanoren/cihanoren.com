@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="max-w-2xl space-y-6">

        @if(session('success'))
            <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- SEO --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <h2 class="text-sm font-bold text-white">SEO & Meta</h2>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Site Title *</label>
                <input type="text" name="site_title" value="{{ old('site_title', $settings['site_title']) }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Meta Description</label>
                <textarea name="meta_description" rows="2"
                          class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all resize-none">{{ old('meta_description', $settings['meta_description']) }}</textarea>
            </div>
        </div>

        {{-- Hero --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <h2 class="text-sm font-bold text-white">Hero Section</h2>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Badge Text</label>
                <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge']) }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all"
                       placeholder="Available for freelance work">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Hero Title</label>
                <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title']) }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all"
                       placeholder="Flutter Developer & Mobile Architect">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Hero Subtitle</label>
                <textarea name="hero_subtitle" rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all resize-none"
                          placeholder="I build clean, scalable mobile applications...">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
            </div>
        </div>

        {{-- Skills --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <h2 class="text-sm font-bold text-white">Skills</h2>
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Skills List</label>
                <textarea name="skills" rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all resize-none"
                          placeholder="Flutter, GetX, Firebase, ...">{{ old('skills', $settings['skills']) }}</textarea>
                <p class="mt-1.5 text-xs text-gray-600">Virgülle ayır: Flutter, GetX, Firebase</p>
            </div>
        </div>

        {{-- Links --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <h2 class="text-sm font-bold text-white">Social Links</h2>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $settings['github_url']) }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all"
                       placeholder="https://github.com/cihanoren">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">LinkedIn URL</label>
                <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url']) }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all"
                       placeholder="https://linkedin.com/in/cihanoren">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Contact Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 transition-all"
                       placeholder="cihan@cihanoren.com">
            </div>
        </div>

        {{-- CV PDF --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-4">
            <h2 class="text-sm font-bold text-white">CV / Resume</h2>

            @if($settings['cv_filename'])
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-sm text-emerald-400">cv.pdf uploaded</span>
                    <a href="/cv.pdf" target="_blank" class="ml-auto text-xs text-emerald-400 hover:text-emerald-300 underline">View</a>
                </div>
            @endif

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                    {{ $settings['cv_filename'] ? 'Replace CV PDF' : 'Upload CV PDF' }}
                </label>
                <input type="file" name="cv_file" accept=".pdf"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-gray-400 text-sm focus:outline-none focus:border-indigo-500/60 transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-indigo-500/20 file:text-indigo-400 hover:file:bg-indigo-500/30">
                <p class="mt-1.5 text-xs text-gray-600">Max 5MB, PDF only. Uploaded to public/cv.pdf</p>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-600/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Settings
            </button>
        </div>

    </div>
</form>

@endsection