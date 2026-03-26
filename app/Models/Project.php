<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'cover_image',
        'tags',
        'project_url',
        'github_url',
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
}