@extends('layouts.admin')

@section('title', 'Education')
@section('page-title', 'Education')

@section('content')

<div class="flex items-center justify-between mb-8">
    <p class="text-sm text-gray-500">{{ $educations->count() }} education{{ $educations->count() !== 1 ? 's' : '' }} total</p>
    <a href="{{ route('admin.education.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-600/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Education
    </a>
</div>

@if($educations->isEmpty())
    <div class="rounded-2xl border border-dashed border-white/[0.08] p-16 flex flex-col items-center justify-center gap-4 text-center">
        <div class="w-12 h-12 rounded-xl bg-white/[0.03] border border-white/[0.07] flex items-center justify-center">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0H9m3 0h3"/>
            </svg>
        </div>
        <div>
            <p class="text-white font-semibold mb-1">No education yet</p>
            <p class="text-sm text-gray-600">Add your educational background.</p>
        </div>
        <a href="{{ route('admin.education.create') }}"
           class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-semibold text-sm transition-all">
            Add Education
        </a>
    </div>

@else
    <div class="space-y-3">
        @foreach($educations as $edu)
        <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] p-5 flex items-center justify-between gap-6">
            <div class="flex items-center gap-5 min-w-0">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/15 border border-indigo-500/20 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0H9m3 0h3"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-2.5 mb-0.5">
                        <p class="text-sm font-bold text-white">{{ $edu->school }}</p>
                        @if($edu->current)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium">
                                <span class="w-1 h-1 rounded-full bg-emerald-400"></span>
                                Current
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-400">
                        {{ $edu->department }}
                        @if($edu->degree) · {{ $edu->degree }} @endif
                    </p>
                    <p class="text-xs text-gray-600 mt-1">{{ $edu->date_range }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('admin.education.edit', $edu) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-gray-400 hover:text-white hover:border-white/20 text-xs font-medium transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.education.destroy', $edu) }}"
                      onsubmit="return confirm('Delete this education?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/[0.08] border border-red-500/20 text-red-400 hover:bg-red-500/20 text-xs font-medium transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection