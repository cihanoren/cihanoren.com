{{-- Shared form partial --}}
<div class="max-w-2xl space-y-6">

    @if($errors->any())
        <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Company & Position --}}
    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
        <h2 class="text-sm font-bold text-white">Position Info</h2>

        <div>
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Position / Title *</label>
            <input type="text" name="position" value="{{ old('position', $experience->position ?? '') }}"
                   class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('position') border-red-500/50 @enderror"
                   placeholder="Flutter Developer">
            @error('position') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Company *</label>
            <input type="text" name="company" value="{{ old('company', $experience->company ?? '') }}"
                   class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all @error('company') border-red-500/50 @enderror"
                   placeholder="Company Name">
            @error('company') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Location</label>
            <input type="text" name="location" value="{{ old('location', $experience->location ?? '') }}"
                   class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all"
                   placeholder="Istanbul, Turkey / Remote">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Description</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/60 focus:bg-white/[0.06] transition-all resize-none"
                      placeholder="What did you do in this role...">{{ old('description', $experience->description ?? '') }}</textarea>
        </div>
    </div>

    {{-- Dates --}}
    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6 space-y-5">
        <h2 class="text-sm font-bold text-white">Dates</h2>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Start Date *</label>
                <input type="month" name="start_date"
                       value="{{ old('start_date', isset($experience) ? $experience->start_date?->format('Y-m') : '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all @error('start_date') border-red-500/50 @enderror">
                @error('start_date') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>
            <div id="end-date-wrapper">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">End Date</label>
                <input type="month" name="end_date"
                       value="{{ old('end_date', isset($experience) && !$experience->current ? $experience->end_date?->format('Y-m') : '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all @error('end_date') border-red-500/50 @enderror">
                @error('end_date') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Current job toggle --}}
        <label class="flex items-center justify-between cursor-pointer">
            <div>
                <p class="text-sm font-medium text-gray-300">Currently working here</p>
                <p class="text-xs text-gray-600">End date will be hidden</p>
            </div>
            <div class="relative">
                <input type="hidden" name="current" value="0">
                <input type="checkbox" name="current" value="1" id="current-toggle" class="sr-only peer"
                       {{ old('current', $experience->current ?? false) ? 'checked' : '' }}>
                <div class="w-10 h-6 bg-white/[0.08] peer-checked:bg-indigo-600 rounded-full transition-colors border border-white/[0.1] peer-checked:border-indigo-500"></div>
                <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 shadow"></div>
            </div>
        </label>
    </div>

    {{-- Order --}}
    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-6">
        <h2 class="text-sm font-bold text-white mb-5">Settings</h2>
        <div class="max-w-xs">
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Display Order</label>
            <input type="number" name="order" value="{{ old('order', $experience->order ?? 0) }}" min="0"
                   class="w-full px-4 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-white text-sm focus:outline-none focus:border-indigo-500/60 transition-all">
            <p class="mt-1.5 text-xs text-gray-600">Küçük sayı önce gelir</p>
        </div>
    </div>

    {{-- Submit --}}
    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.experience.index') }}"
           class="px-5 py-2.5 rounded-xl border border-white/[0.08] text-gray-400 hover:text-white hover:border-white/20 text-sm font-medium transition-all">
            Cancel
        </a>
        <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-600/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Save Experience
        </button>
    </div>

</div>

<script>
    const toggle = document.getElementById('current-toggle');
    const endDateWrapper = document.getElementById('end-date-wrapper');

    function updateEndDate() {
        endDateWrapper.style.opacity = toggle.checked ? '0.3' : '1';
        endDateWrapper.querySelector('input').disabled = toggle.checked;
    }

    toggle.addEventListener('change', updateEndDate);
    updateEndDate();
</script>