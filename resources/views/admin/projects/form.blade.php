{{-- Shared form partial --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Sol: Ana bilgiler --}}
    <div class="lg:col-span-2 space-y-5">

        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <h2 class="text-sm font-bold text-white">Project Info</h2>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Title *</label>
                <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('title') border-red-500/50 @enderror"
                       placeholder="EduChamp">
                @error('title') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Short Description *</label>
                <textarea name="description" rows="2"
                          class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all resize-none @error('description') border-red-500/50 @enderror"
                          placeholder="Kısa açıklama — proje kartlarında gösterilir">{{ old('description', $project->description ?? '') }}</textarea>
                @error('description') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Full Content</label>
                <textarea name="content" rows="8"
                          class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all resize-y @error('content') border-red-500/50 @enderror"
                          placeholder="Proje detay sayfasında gösterilecek uzun içerik...">{{ old('content', $project->content ?? '') }}</textarea>
                @error('content') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Tags</label>
                <input type="text" name="tags"
                       value="{{ old('tags', isset($project) ? implode(', ', $project->tags ?? []) : '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all"
                       placeholder="Flutter, GetX, Laravel">
                <p class="mt-1.5 text-xs text-gray-600">Virgülle ayır</p>
            </div>
        </div>

        {{-- Cover Image --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-4">
            <h2 class="text-sm font-bold text-white">Cover Image</h2>

            {{-- Mevcut resim (edit modunda) --}}
            @if(isset($project) && $project->cover_image)
                <div id="current-image">
                    <p class="text-xs text-gray-500 mb-2">Current image</p>
                    <img src="{{ Storage::url($project->cover_image) }}"
                         alt="Cover"
                         class="w-full h-40 object-cover rounded-xl border border-white/[0.08]">
                    <div class="mt-3">
                        <input type="hidden" name="remove_cover_image" value="0" id="remove_cover_image_input">
                        <button type="button"
                                onclick="document.getElementById('remove_cover_image_input').value='1'; document.getElementById('current-image').classList.add('opacity-30');"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/[0.08] border border-red-500/20 text-red-400 hover:bg-red-500/20 text-xs font-medium transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Remove image
                        </button>
                    </div>
                    <p class="text-xs text-gray-600 mt-3">Yeni resim yükleyerek mevcut resmi değiştirebilirsin</p>
                </div>
            @endif

            {{-- Upload alanı --}}
            <div class="relative">
                <input type="file" name="cover_image" id="cover_image"
                       accept="image/jpg,image/jpeg,image/png,image/webp"
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                       onchange="previewCoverImage(this)">
                <div class="border-2 border-dashed border-white/[0.08] rounded-xl p-8 text-center hover:border-indigo-500/40 transition-colors">
                    <div id="upload-placeholder">
                        <svg class="w-8 h-8 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-gray-400 font-medium">Yüklemek için tıkla</p>
                        <p class="text-xs text-gray-600 mt-1">JPG, PNG, WebP — max 2MB</p>
                    </div>
                    <div id="upload-preview" class="hidden">
                        <img id="preview-img" src="" alt="Preview"
                             class="w-full h-40 object-cover rounded-xl mx-auto">
                        <p class="text-xs text-gray-400 mt-2" id="preview-name"></p>
                    </div>
                </div>
            </div>
            @error('cover_image') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Links --}}
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
            <h2 class="text-sm font-bold text-white">Links</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>
                            </svg>
                            Website
                        </span>
                    </label>
                    <input type="url" name="project_url" value="{{ old('project_url', $project->project_url ?? '') }}"
                           class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('project_url') border-red-500/50 @enderror"
                           placeholder="https://educhamp.com.tr">
                    @error('project_url') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                            </svg>
                            GitHub
                        </span>
                    </label>
                    <input type="url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}"
                           class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('github_url') border-red-500/50 @enderror"
                           placeholder="https://github.com/cihanoren/...">
                    @error('github_url') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                            </svg>
                            App Store
                        </span>
                    </label>
                    <input type="url" name="appstore_url" value="{{ old('appstore_url', $project->appstore_url ?? '') }}"
                           class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('appstore_url') border-red-500/50 @enderror"
                           placeholder="https://apps.apple.com/...">
                    @error('appstore_url') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3.18 23.76c.3.17.65.19.97.07L13.86 12 3.18 23.76zM.15 1.17C.06 1.38 0 1.62 0 1.89v20.22c0 .27.06.51.15.72L12.16 12 .15 1.17zM20.23 10.55l-2.79-1.6L14.2 12l3.24 3.05 2.79-1.6c.8-.46.8-1.9 0-2.9zM3.18.24L13.86 12 3.18 23.76c.32.12.67.1.97-.07l13.5-7.75c.8-.46.8-1.9 0-2.9L4.15.31C3.83.13 3.48.12 3.18.24z"/>
                            </svg>
                            Play Store
                        </span>
                    </label>
                    <input type="url" name="playstore_url" value="{{ old('playstore_url', $project->playstore_url ?? '') }}"
                           class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('playstore_url') border-red-500/50 @enderror"
                           placeholder="https://play.google.com/store/apps/...">
                    @error('playstore_url') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

    </div>

    {{-- Sağ: Ayarlar --}}
    <div class="space-y-5">

        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-4">
            <h2 class="text-sm font-bold text-white">Settings</h2>

            {{-- Published --}}
            <label class="flex items-center justify-between cursor-pointer">
                <div>
                    <p class="text-sm font-medium text-gray-300">Published</p>
                    <p class="text-xs text-gray-600">Public sitede görünsün</p>
                </div>
                <div class="relative">
                    <input type="hidden" name="published" value="0">
                    <input type="checkbox" name="published" value="1" class="sr-only peer"
                           {{ old('published', $project->published ?? true) ? 'checked' : '' }}>
                    <div class="w-10 h-6 bg-white/[0.08] peer-checked:bg-indigo-600 rounded-full transition-colors border border-white/[0.1] peer-checked:border-indigo-500"></div>
                    <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 shadow"></div>
                </div>
            </label>

            {{-- Featured --}}
            <label class="flex items-center justify-between cursor-pointer">
                <div>
                    <p class="text-sm font-medium text-gray-300">Featured</p>
                    <p class="text-xs text-gray-600">Ana sayfada göster</p>
                </div>
                <div class="relative">
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" name="featured" value="1" class="sr-only peer"
                           {{ old('featured', $project->featured ?? false) ? 'checked' : '' }}>
                    <div class="w-10 h-6 bg-white/[0.08] peer-checked:bg-amber-500 rounded-full transition-colors border border-white/[0.1] peer-checked:border-amber-400"></div>
                    <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 shadow"></div>
                </div>
            </label>

            {{-- Order --}}
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Display Order</label>
                <input type="number" name="order" value="{{ old('order', $project->order ?? 0) }}" min="0"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all">
                <p class="mt-1.5 text-xs text-gray-600">Küçük sayı önce gelir</p>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Save Project
        </button>

        <a href="{{ route('admin.projects.index') }}"
           class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 border border-white/[0.08] text-gray-400 hover:text-white hover:border-white/20 rounded-xl text-sm font-medium transition-all">
            Cancel
        </a>

    </div>
</div>

<script>
function previewCoverImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview-name').textContent = input.files[0].name;
            document.getElementById('upload-placeholder').classList.add('hidden');
            document.getElementById('upload-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>