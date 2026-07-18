<?php

namespace Database\Seeders;

 
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Admin Permissions
    $adminRole = Role::firstWhere('name', 'Admin');

    $permissions = Permission::all();

    $adminRole->permissions()->sync(
        $permissions->pluck('id')
    );

    // Staff Permissions
    $staffRole = Role::firstWhere('name', 'Staff');

    $staffPermissions = Permission::whereIn('name', [
        'dashboard.view',
        'reports.view',
        'products.view',
        'categories.view',
        'suppliers.view',
        'purchases.view',
        'purchases.create',
        'sales.view',
        'sales.create',
    ])->pluck('id');
    

    $staffRole->permissions()->sync($staffPermissions);
}
}
