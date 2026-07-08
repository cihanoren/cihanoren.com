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

        {{-- About Page --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <h2 class="text-sm font-bold text-white">About Page Content</h2>
            <p class="text-xs text-gray-500 -mt-2">/about sayfasındaki başlık ve alt metin. İki dili de doldurun.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <p class="mono text-[11px] uppercase tracking-wide text-cyan-400">Türkçe</p>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Başlık (1. satır)</label>
                        <input type="text" name="about_title_tr" value="{{ old('about_title_tr', $settings['about_title_tr']) }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Başlık (vurgulu 2. satır)</label>
                        <input type="text" name="about_title2_tr" value="{{ old('about_title2_tr', $settings['about_title2_tr']) }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Alt Metin</label>
                        <textarea name="about_sub_tr" rows="3"
                                  class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all resize-none">{{ old('about_sub_tr', $settings['about_sub_tr']) }}</textarea>
                    </div>
                </div>
                <div class="space-y-4">
                    <p class="mono text-[11px] uppercase tracking-wide text-purple-400">English</p>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Title (line 1)</label>
                        <input type="text" name="about_title_en" value="{{ old('about_title_en', $settings['about_title_en']) }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Title (highlighted line 2)</label>
                        <input type="text" name="about_title2_en" value="{{ old('about_title2_en', $settings['about_title2_en']) }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Subtitle</label>
                        <textarea name="about_sub_en" rows="3"
                                  class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all resize-none">{{ old('about_sub_en', $settings['about_sub_en']) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Skills & Technologies --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-bold text-white">Skills & Technologies</h2>
                <button type="button" id="add-category" class="text-xs font-medium text-indigo-400 hover:text-indigo-300 inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Kategori ekle
                </button>
            </div>
            <p class="text-xs text-gray-500 -mt-3">Bu kategoriler /about sayfasında kart olarak görünür.</p>

            <div id="category-rows" class="space-y-4">
                @foreach($skillCategories as $i => $cat)
                    <div class="category-row grid grid-cols-1 md:grid-cols-[140px_1fr_auto] gap-3 items-start p-4 rounded-xl border border-white/[0.06] bg-white/[0.015]">
                        <select name="categories[{{ $i }}][icon]" class="px-3 py-2.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60">
                            @foreach(['mobile'=>'Mobile','backend'=>'Backend','ai'=>'AI','code'=>'Code','database'=>'Database','cloud'=>'Cloud','design'=>'Design','globe'=>'Web'] as $key => $label)
                                <option value="{{ $key }}" @selected($cat['icon'] === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <div class="space-y-2">
                            <input type="text" name="categories[{{ $i }}][title]" value="{{ $cat['title'] }}" placeholder="Kategori adı (örn. Mobile)"
                                   class="w-full px-3 py-2.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60">
                            <input type="text" name="categories[{{ $i }}][skills]" value="{{ $cat['skills'] }}" placeholder="Flutter, Dart, GetX, ..."
                                   class="w-full px-3 py-2.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60">
                        </div>
                        <button type="button" class="remove-category h-10 w-10 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-500/10 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endforeach
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
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <h2 class="text-sm font-bold text-white">CV / Resume</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <p class="mono text-[11px] uppercase tracking-wide text-cyan-400">Türkçe</p>
                    @if($settings['cv_filename_tr'])
                        <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm text-emerald-400 truncate">{{ $settings['cv_filename_tr'] }}</span>
                            <a href="/{{ $settings['cv_filename_tr'] }}" target="_blank" class="ml-auto text-xs text-emerald-400 hover:text-emerald-300 underline shrink-0">View</a>
                        </div>
                    @endif
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                            {{ $settings['cv_filename_tr'] ? 'Replace CV (TR)' : 'Upload CV (TR)' }}
                        </label>
                        <input type="file" name="cv_file_tr" accept=".pdf"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-gray-400 text-sm focus:outline-none focus:border-indigo-500/60 transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-indigo-500/20 file:text-indigo-400 hover:file:bg-indigo-500/30">
                    </div>
                </div>
                <div class="space-y-3">
                    <p class="mono text-[11px] uppercase tracking-wide text-purple-400">English</p>
                    @if($settings['cv_filename_en'])
                        <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm text-emerald-400 truncate">{{ $settings['cv_filename_en'] }}</span>
                            <a href="/{{ $settings['cv_filename_en'] }}" target="_blank" class="ml-auto text-xs text-emerald-400 hover:text-emerald-300 underline shrink-0">View</a>
                        </div>
                    @endif
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                            {{ $settings['cv_filename_en'] ? 'Replace CV (EN)' : 'Upload CV (EN)' }}
                        </label>
                        <input type="file" name="cv_file_en" accept=".pdf"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-gray-400 text-sm focus:outline-none focus:border-indigo-500/60 transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-indigo-500/20 file:text-indigo-400 hover:file:bg-indigo-500/30">
                    </div>
                </div>
            </div>
            <p class="text-xs text-gray-600">Max 5MB, her biri için PDF only.</p>
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

<script>
(function() {
    const rows = document.getElementById('category-rows');
    const addBtn = document.getElementById('add-category');
    const iconOptions = {mobile:'Mobile',backend:'Backend',ai:'AI',code:'Code',database:'Database',cloud:'Cloud',design:'Design',globe:'Web'};

    function reindex() {
        [...rows.children].forEach((row, i) => {
            row.querySelectorAll('[name]').forEach(el => {
                el.name = el.name.replace(/categories\[\d+\]/, `categories[${i}]`);
            });
        });
    }

    addBtn.addEventListener('click', () => {
        const i = rows.children.length;
        const select = Object.entries(iconOptions).map(([k,l]) => `<option value="${k}">${l}</option>`).join('');
        const row = document.createElement('div');
        row.className = 'category-row grid grid-cols-1 md:grid-cols-[140px_1fr_auto] gap-3 items-start p-4 rounded-xl border border-white/[0.06] bg-white/[0.015]';
        row.innerHTML = `
            <select name="categories[${i}][icon]" class="px-3 py-2.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60">${select}</select>
            <div class="space-y-2">
                <input type="text" name="categories[${i}][title]" placeholder="Kategori adı (örn. Mobile)" class="w-full px-3 py-2.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60">
                <input type="text" name="categories[${i}][skills]" placeholder="Flutter, Dart, GetX, ..." class="w-full px-3 py-2.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60">
            </div>
            <button type="button" class="remove-category h-10 w-10 flex items-center justify-center rounded-lg text-red-400 hover:bg-red-500/10 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>`;
        rows.appendChild(row);
    });

    rows.addEventListener('click', (e) => {
        const btn = e.target.closest('.remove-category');
        if (!btn) return;
        btn.closest('.category-row').remove();
        reindex();
    });
})();
</script>

@endsection