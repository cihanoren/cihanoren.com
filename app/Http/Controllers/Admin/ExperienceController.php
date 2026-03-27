<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Activity;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('order')->orderByDesc('start_date')->get();
        return view('admin.experience.experience-index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experience.experience-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company'     => ['required', 'string', 'max:255'],
            'position'    => ['required', 'string', 'max:255'],
            'location'    => ['nullable', 'string', 'max:255'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after:start_date'],
            'current'     => ['boolean'],
            'description' => ['nullable', 'string'],
            'order'       => ['integer'],
        ]);

        $validated['current'] = $request->boolean('current');

        if ($validated['current']) {
            $validated['end_date'] = null;
        }

        $experience = Experience::create($validated);

        Activity::log('created', 'Experience', "\"{$experience->position}\" pozisyonu eklendi.");

        return redirect()->route('admin.experience.index')
                         ->with('success', 'Experience added successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experience.experience-edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company'     => ['required', 'string', 'max:255'],
            'position'    => ['required', 'string', 'max:255'],
            'location'    => ['nullable', 'string', 'max:255'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after:start_date'],
            'current'     => ['boolean'],
            'description' => ['nullable', 'string'],
            'order'       => ['integer'],
        ]);

        $validated['current'] = $request->boolean('current');

        if ($validated['current']) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);

        Activity::log('updated', 'Experience', "\"{$experience->position}\" pozisyonu güncellendi.");

        return redirect()->route('admin.experience.index')
                         ->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $position = $experience->position;
        $experience->delete();

        Activity::log('deleted', 'Experience', "\"{$position}\" pozisyonu silindi.");

        return redirect()->route('admin.experience.index')
                         ->with('success', 'Experience deleted.');
    }
}