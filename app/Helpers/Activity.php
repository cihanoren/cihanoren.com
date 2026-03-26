<?php

namespace App\Helpers;

use App\Models\ActivityLog;

class Activity
{
    public static function log(string $action, string $model, string $description): void
    {
        ActivityLog::create([
            'action'      => $action,
            'model'       => $model,
            'description' => $description,
            'ip_address'  => request()->ip(),
        ]);
    }
}