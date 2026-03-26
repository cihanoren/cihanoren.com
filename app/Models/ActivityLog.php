<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'action',
        'model',
        'description',
        'ip_address',
    ];

    // İkon ve renk — dashboard'da kullanacağız
    public function getColorAttribute(): string
    {
        return match($this->action) {
            'created' => 'emerald',
            'updated' => 'indigo',
            'deleted' => 'red',
            'login'   => 'violet',
            default   => 'gray',
        };
    }

    public function getIconAttribute(): string
    {
        return match($this->action) {
            'created' => 'plus',
            'updated' => 'pencil',
            'deleted' => 'trash',
            'login'   => 'lock',
            default   => 'dot',
        };
    }
}