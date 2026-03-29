<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Activity;
use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order')->orderByDesc('start_date')->get();
        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school'      => ['required', 'string', 'max:255'],
            'degree'      => ['nullable', 'string', 'max:255'],
            'department'  => ['required', 'string', 'max:255'],
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

        $education = Education::create($validated);

        Activity::log('created', 'Education', "\"{$education->school}\" eğitimi eklendi.");

        return redirect()->route('admin.education.index')
                         ->with('success', 'Education added successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'school'      => ['required', 'string', 'max:255'],
            'degree'      => ['nullable', 'string', 'max:255'],
            'department'  => ['required', 'string', 'max:255'],
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

        $education->update($validated);

        Activity::log('updated', 'Education', "\"{$education->school}\" eğitimi güncellendi.");

        return redirect()->route('admin.education.index')
                         ->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $school = $education->school;
        $education->delete();

        Activity::log('deleted', 'Education', "\"{$school}\" eğitimi silindi.");

        return redirect()->route('admin.education.index')
                         ->with('success', 'Education deleted.');
    }
}