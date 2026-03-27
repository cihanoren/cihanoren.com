<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company',
        'position',
        'location',
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
        $start = $this->start_date->format('M Y');
        $end = $this->current ? 'Present' : ($this->end_date?->format('M Y') ?? '');
        return "$start — $end";
    }
}