<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            'dashboard.view',

            'reports.view',

            'activity_logs.view',

            'products.view',
            'products.create',
            'products.edit',
            'products.delete',

            'categories.view',
            'categories.create',
            'categories.edit',
            'categories.delete',

            'suppliers.view',
            'suppliers.create',
            'suppliers.edit',
            'suppliers.delete',

            'purchases.view',
            'purchases.create',
            'purchases.edit',
            'purchases.delete',

            'sales.view',
            'sales.create',
            'sales.edit',
            'sales.delete',

            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }
    }
}