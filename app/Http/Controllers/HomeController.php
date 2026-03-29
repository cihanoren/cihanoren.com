<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
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

    public function about()
    {
        $experiences = Experience::orderBy('order')
            ->orderByDesc('start_date')
            ->get();

        $educations = Education::orderBy('order')
            ->orderByDesc('start_date')
            ->get();

        return view('public.about', compact('experiences', 'educations'));
    }

    public function resume()
    {
        $experiences = Experience::orderBy('order')
            ->orderByDesc('start_date')
            ->get();

        $educations = Education::orderBy('order')
            ->orderByDesc('start_date')
            ->get();

        return view('public.resume', compact('experiences', 'educations'));
    }
}