<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@bizzsoft.dev'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'status' => 'active',
            ]
        );

        User::firstOrCreate(
            ['email' => 'staff@bizzsoft.dev'],
            [
                'name' => 'Staff',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'status' => 'active',
            ]
        );
    }
}