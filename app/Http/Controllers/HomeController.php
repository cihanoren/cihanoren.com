<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('published', true)
            ->where('featured', true)
            ->orderBy('order')
            ->get();

        return view('public.home', compact('featuredProjects'));
    }
}