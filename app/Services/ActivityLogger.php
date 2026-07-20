<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogger
{
    public static function log(
        string $action,
        string $module,
        string $description
    )
    {
        ActivityLog::create([
    'user_id' => auth()->id(),
    'action' => $action,
    'module' => $module,
    'description' => $description,
]);
    }
}