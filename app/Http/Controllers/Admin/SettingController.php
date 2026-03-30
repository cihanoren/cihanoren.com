<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Activity;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_title'        => Setting::get('site_title', 'CihanÖren — Flutter Developer'),
            'meta_description'  => Setting::get('meta_description', 'Flutter mobile developer specializing in clean architecture and scalable apps.'),
            'hero_title'        => Setting::get('hero_title', 'Flutter Developer & Mobile Architect'),
            'hero_subtitle'     => Setting::get('hero_subtitle', 'I build clean, scalable mobile applications with Flutter — focused on architecture, performance, and great UX.'),
            'hero_badge'        => Setting::get('hero_badge', 'Available for freelance work'),
            'skills'            => Setting::get('skills', 'Flutter, Clean Architecture, GetX, REST APIs, Firebase, iOS & Android, LLM Integration, AI-Powered Apps'),
            'github_url'        => Setting::get('github_url', 'https://github.com/cihanoren'),
            'linkedin_url'      => Setting::get('linkedin_url', 'https://linkedin.com/in/cihanoren'),
            'contact_email'     => Setting::get('contact_email', 'cihan@cihanoren.com'),
            'cv_filename'       => Setting::get('cv_filename', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title'       => ['required', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'hero_title'       => ['nullable', 'string', 'max:255'],
            'hero_subtitle'    => ['nullable', 'string', 'max:500'],
            'hero_badge'       => ['nullable', 'string', 'max:100'],
            'skills'           => ['nullable', 'string'],
            'github_url'       => ['nullable', 'url', 'max:255'],
            'linkedin_url'     => ['nullable', 'url', 'max:255'],
            'contact_email'    => ['nullable', 'email', 'max:255'],
        ]);

        Setting::setMany($validated);

        // CV PDF upload
        if ($request->hasFile('cv_file')) {
            $request->validate(['cv_file' => ['file', 'mimes:pdf', 'max:5120']]);
            $file = $request->file('cv_file');
            $file->move(public_path(), 'cv.pdf');
            Setting::set('cv_filename', 'cv.pdf');
        }

        Activity::log('updated', 'Settings', 'Site ayarları güncellendi.');

        return back()->with('success', 'Settings saved successfully.');
    }
}