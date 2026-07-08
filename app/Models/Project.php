<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'description',
        'description_en',
        'content',
        'content_en',
        'cover_image',
        'tags',
        'project_url',
        'github_url',
        'appstore_url',
        'playstore_url',
        'featured',
        'order',
        'published',
    ];

    protected function casts(): array
    {
        return [
            'tags'      => 'array',
            'featured'  => 'boolean',
            'published' => 'boolean',
        ];
    }

    // Title'dan otomatik slug oluştur
    public static function generateSlug(string $title): string
    {
        return Str::slug($title);
    }

    /* ── Localized accessors ──────────────────────────────────────────
       Base columns hold the default (TR) content. When the app locale is
       'en' and the *_en column is filled, that is returned; otherwise it
       falls back to the base column, so existing projects never break. */

    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localize('title');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localize('description');
    }

    public function getLocalizedContentAttribute(): ?string
    {
        return $this->localize('content');
    }

    protected function localize(string $field): ?string
    {
        if (app()->getLocale() === 'en') {
            $en = $this->{$field . '_en'};
            return filled($en) ? $en : $this->{$field};
        }

        return $this->{$field};
    }
}