<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('public.projects');
    }

    public function show(string $slug)
    {
        return view('public.project-detail', compact('slug'));
    }
}