<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Activity;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private function defaultCategories(): array
    {
        return [
            ['icon' => 'mobile',  'title' => 'Mobile',         'skills' => 'Flutter, Dart, iOS & Android, GetX, Clean Architecture'],
            ['icon' => 'backend', 'title' => 'Backend & APIs', 'skills' => 'Laravel, REST APIs, Firebase'],
            ['icon' => 'ai',      'title' => 'AI',             'skills' => 'LLM Integration, AI-Powered Apps'],
        ];
    }

    private function defaultStats(): array
    {
        return [
            ['value' => '3+',            'label_tr' => 'YIL DENEYİM',        'label_en' => 'YEARS EXPERIENCE'],
            ['value' => '10+',           'label_tr' => 'YAYINLANAN UYGULAMA', 'label_en' => 'APPS SHIPPED'],
            ['value' => 'iOS & Android', 'label_tr' => 'HER İKİ PLATFORM',    'label_en' => 'BOTH PLATFORMS'],
        ];
    }

    public function index()
    {
        $settings = [
            'site_title'        => Setting::get('site_title', 'CihanÖren — Flutter Developer'),
            'meta_description'  => Setting::get('meta_description', 'Flutter mobile developer specializing in clean architecture and scalable apps.'),

            'hero_badge_tr'     => Setting::get('hero_badge_tr', Setting::get('hero_badge', 'Freelance çalışmaya açık')),
            'hero_badge_en'     => Setting::get('hero_badge_en', Setting::get('hero_badge', 'Available for freelance work')),
            'hero_title_tr'     => Setting::get('hero_title_tr', Setting::get('hero_title', 'Flutter Geliştirici & Mobil Mimar')),
            'hero_title_en'     => Setting::get('hero_title_en', Setting::get('hero_title', 'Flutter Developer & Mobile Architect')),
            'hero_subtitle_tr'  => Setting::get('hero_subtitle_tr', Setting::get('hero_subtitle', 'Mimari, performans ve kullanıcı deneyimine odaklanan temiz ve ölçeklenebilir mobil uygulamalar geliştiriyorum.')),
            'hero_subtitle_en'  => Setting::get('hero_subtitle_en', Setting::get('hero_subtitle', 'I build clean, scalable mobile applications with Flutter — focused on architecture, performance, and great UX.')),

            'about_title_tr'    => Setting::get('about_title_tr', __('messages.about_title')),
            'about_title2_tr'   => Setting::get('about_title2_tr', __('messages.about_title2')),
            'about_sub_tr'      => Setting::get('about_sub_tr', __('messages.about_sub')),
            'about_title_en'    => Setting::get('about_title_en', __('messages.about_title')),
            'about_title2_en'   => Setting::get('about_title2_en', __('messages.about_title2')),
            'about_sub_en'      => Setting::get('about_sub_en', __('messages.about_sub')),

            'github_url'        => Setting::get('github_url', 'https://github.com/cihanoren'),
            'linkedin_url'      => Setting::get('linkedin_url', 'https://linkedin.com/in/cihanoren'),
            'contact_email'     => Setting::get('contact_email', 'cihan@cihanoren.com'),

            'cv_filename_tr'    => Setting::get('cv_filename_tr', ''),
            'cv_filename_en'    => Setting::get('cv_filename_en', ''),
        ];

        $skillCategories = json_decode(
            Setting::get('skill_categories', json_encode($this->defaultCategories())),
            true
        ) ?: $this->defaultCategories();

        $homeStats = json_decode(
            Setting::get('home_stats', json_encode($this->defaultStats())),
            true
        ) ?: $this->defaultStats();

        return view('admin.settings.index', compact('settings', 'skillCategories', 'homeStats'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title'       => ['required', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],

            'hero_badge_tr'    => ['nullable', 'string', 'max:100'],
            'hero_badge_en'    => ['nullable', 'string', 'max:100'],
            'hero_title_tr'    => ['nullable', 'string', 'max:255'],
            'hero_title_en'    => ['nullable', 'string', 'max:255'],
            'hero_subtitle_tr' => ['nullable', 'string', 'max:500'],
            'hero_subtitle_en' => ['nullable', 'string', 'max:500'],

            'about_title_tr'   => ['nullable', 'string', 'max:255'],
            'about_title2_tr'  => ['nullable', 'string', 'max:255'],
            'about_sub_tr'     => ['nullable', 'string', 'max:500'],
            'about_title_en'   => ['nullable', 'string', 'max:255'],
            'about_title2_en'  => ['nullable', 'string', 'max:255'],
            'about_sub_en'     => ['nullable', 'string', 'max:500'],

            'categories'                => ['nullable', 'array'],
            'categories.*.icon'         => ['nullable', 'string', 'max:50'],
            'categories.*.title'        => ['nullable', 'string', 'max:100'],
            'categories.*.skills'       => ['nullable', 'string'],

            'stats'                     => ['nullable', 'array'],
            'stats.*.value'             => ['nullable', 'string', 'max:50'],
            'stats.*.label_tr'          => ['nullable', 'string', 'max:100'],
            'stats.*.label_en'          => ['nullable', 'string', 'max:100'],

            'github_url'       => ['nullable', 'url', 'max:255'],
            'linkedin_url'     => ['nullable', 'url', 'max:255'],
            'contact_email'    => ['nullable', 'email', 'max:255'],
        ]);

        // Skill categories -> JSON
        $categories = collect($request->input('categories', []))
            ->filter(fn ($c) => !empty($c['title']))
            ->map(fn ($c) => [
                'icon'   => $c['icon'] ?? 'code',
                'title'  => $c['title'],
                'skills' => $c['skills'] ?? '',
            ])
            ->values()
            ->all();

        // Home stats -> JSON
        $stats = collect($request->input('stats', []))
            ->filter(fn ($s) => !empty($s['value']))
            ->map(fn ($s) => [
                'value'    => $s['value'],
                'label_tr' => $s['label_tr'] ?? '',
                'label_en' => $s['label_en'] ?? '',
            ])
            ->values()
            ->all();

        unset($validated['categories'], $validated['stats']);
        $validated['skill_categories'] = json_encode($categories);
        $validated['home_stats'] = json_encode($stats);

        Setting::setMany($validated);

        // CV PDFs (TR / EN)
        if ($request->hasFile('cv_file_tr')) {
            $request->validate(['cv_file_tr' => ['file', 'mimes:pdf', 'max:5120']]);
            $request->file('cv_file_tr')->move(public_path(), 'cv-tr.pdf');
            Setting::set('cv_filename_tr', 'cv-tr.pdf');
        }

        if ($request->hasFile('cv_file_en')) {
            $request->validate(['cv_file_en' => ['file', 'mimes:pdf', 'max:5120']]);
            $request->file('cv_file_en')->move(public_path(), 'cv-en.pdf');
            Setting::set('cv_filename_en', 'cv-en.pdf');
        }

        Activity::log('updated', 'Settings', 'Site ayarları güncellendi.');

        return back()->with('success', 'Settings saved successfully.');
    }
}