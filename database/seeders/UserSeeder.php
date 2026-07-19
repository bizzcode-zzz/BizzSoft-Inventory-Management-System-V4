<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
{
    $admin = User::firstOrCreate(
        ['email' => 'admin@bizzsoft.dev'],
        [
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]
    );

    $admin->fill([
        'role_id' => 1,
        'status'  => 'active',
    ]);

    if ($admin->isDirty()) {
        $admin->save();
    }

    $staff = User::firstOrCreate(
        ['email' => 'staff@bizzsoft.dev'],
        [
            'name' => 'Staff',
            'password' => Hash::make('password'),
        ]
    );

    $staff->fill([
        'role_id' => 2,
        'status'  => 'active',
    ]);

    if ($staff->isDirty()) {
        $staff->save();
    }
}
}