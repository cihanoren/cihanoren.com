<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read',
        'is_archived',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'is_read'     => 'boolean',
            'is_archived' => 'boolean',
            'read_at'     => 'datetime',
        ];
    }

    public function markAsRead(): void
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false)->where('is_archived', false);
    }

    public function scopeInbox($query)
    {
        return $query->where('is_archived', false);
    }

    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }
}