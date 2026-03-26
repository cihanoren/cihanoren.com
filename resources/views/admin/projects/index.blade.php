@extends('layouts.admin')

@section('title', 'Projects')
@section('page-title', 'Projects')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">{{ $projects->count() }} project{{ $projects->count() !== 1 ? 's' : '' }}</p>
    <a href="{{ route('admin.projects.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold transition-all shadow-lg shadow-indigo-600/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Project
    </a>
</div>

@if($projects->isEmpty())
    <div class="rounded-2xl border border-dashed border-white/[0.07] p-16 flex flex-col items-center justify-center gap-3 text-center">
        <div class="w-12 h-12 rounded-xl bg-white/[0.03] border border-white/[0.07] flex items-center justify-center">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
        </div>
        <p class="text-gray-600 text-sm">No projects yet.</p>
        <a href="{{ route('admin.projects.create') }}" class="text-indigo-400 hover:text-indigo-300 text-sm transition-colors">Add your first project →</a>
    </div>
@else
    <div class="rounded-2xl border border-white/[0.08] bg-white/[0.02] overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/[0.06]">
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide">Project</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide hidden md:table-cell">Tags</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide hidden md:table-cell">Status</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wide hidden md:table-cell">Featured</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/[0.04]">
                @foreach($projects as $project)
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="px-6 py-4">
                        <p class="text-sm font-semibold text-white">{{ $project->title }}</p>
                        <p class="text-xs text-gray-500 mt-0.5 truncate max-w-xs">{{ $project->description }}</p>
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(($project->tags ?? []) as $tag)
                                <span class="px-2 py-0.5 rounded-md bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        @if($project->published)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium">
                                <span class="w-1 h-1 rounded-full bg-emerald-400"></span>
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-500/10 border border-gray-500/20 text-gray-500 text-xs font-medium">
                                <span class="w-1 h-1 rounded-full bg-gray-500"></span>
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        @if($project->featured)
                            <span class="text-amber-400 text-xs font-medium">★ Featured</span>
                        @else
                            <span class="text-gray-600 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project) }}"
                               class="px-3 py-1.5 rounded-lg bg-white/[0.04] border border-white/[0.08] text-gray-400 hover:text-white hover:border-indigo-500/40 text-xs font-medium transition-all">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                  onsubmit="return confirm('Delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1.5 rounded-lg bg-red-500/5 border border-red-500/20 text-red-400 hover:bg-red-500/10 text-xs font-medium transition-all">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection