<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'school',
        'degree',
        'department',
        'start_date',
        'end_date',
        'current',
        'description',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date'   => 'date',
            'current'    => 'boolean',
        ];
    }

    public function getDateRangeAttribute(): string
    {
        $start = $this->start_date->format('Y');
        $end = $this->current ? 'Present' : ($this->end_date?->format('Y') ?? '');
        return "$start — $end";
    }
}