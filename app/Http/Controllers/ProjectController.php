<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('published', true)
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->get();

        return view('public.projects', compact('projects'));
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        return view('public.project-detail', compact('project'));
    }
}