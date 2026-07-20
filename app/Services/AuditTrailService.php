<?php

namespace App\Services;
use App\Services\ActivityLogger;
class AuditTrailService
{
    public static function logUpdate(
    $oldModel,
    $newModel,
    string $module,
    array $fieldMap,
    string $displayField,
    array $extraChanges = []
) {
    $changes = [];

    foreach ($fieldMap as $field => $label) {

        if ($oldModel->$field != $newModel->$field) {

            $changes[] =
                "{$label}:\n{$oldModel->$field} → {$newModel->$field}";
        }
    }

    $changes = array_merge($changes, $extraChanges);

    if (!empty($changes)) {

        $description =
            "Updated {$module}: {$newModel->$displayField}\n\n";

        $description .= implode("\n\n", $changes);

        ActivityLogger::log(
            'Updated',
            $module,
            $description
        );
    }
}
}