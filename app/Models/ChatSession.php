<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatSession extends Model
{
    protected $fillable = [
        'anonymous_id',
        'email',
        'name',
        'ip_address',
        'user_agent',
        'language',
        'tags',
        'project_idea',
        'personality',
        'lead_score',
        'last_active_at',
    ];

    protected function casts(): array
    {
        return [
            'tags'           => 'array',
            'last_active_at' => 'datetime',
        ];
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}