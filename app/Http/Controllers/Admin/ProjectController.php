<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->orderByDesc('created_at')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'content'      => ['nullable', 'string'],
            'tags'         => ['nullable', 'string'],
            'project_url'  => ['nullable', 'url'],
            'github_url'   => ['nullable', 'url'],
            'featured'     => ['boolean'],
            'order'        => ['integer'],
            'published'    => ['boolean'],
            'cover_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'appstore_url'  => ['nullable', 'url'],
            'playstore_url' => ['nullable', 'url'],
        ]);

        $validated['slug']      = Str::slug($validated['title']);
        $validated['tags']      = $this->parseTags($request->tags);
        $validated['featured']  = $request->boolean('featured');
        $validated['published'] = $request->boolean('published');

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'content'      => ['nullable', 'string'],
            'tags'         => ['nullable', 'string'],
            'project_url'  => ['nullable', 'url'],
            'github_url'   => ['nullable', 'url'],
            'featured'     => ['boolean'],
            'order'        => ['integer'],
            'published'    => ['boolean'],
            'cover_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'appstore_url'  => ['nullable', 'url'],
            'playstore_url' => ['nullable', 'url'],
        ]);

        $validated['slug']      = Str::slug($validated['title']);
        $validated['tags']      = $this->parseTags($request->tags);
        $validated['featured']  = $request->boolean('featured');
        $validated['published'] = $request->boolean('published');

        if ($request->hasFile('cover_image')) {
            // Eski resmi sil
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')
                ->store('projects', 'public');
        }

        // Resmi kaldır butonuna basıldıysa
        if ($request->boolean('remove_cover_image')) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $validated['cover_image'] = null;
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Project deleted.');
    }

    private function parseTags(?string $tags): array
    {
        if (!$tags) return [];
        return array_map('trim', explode(',', $tags));
    }
}