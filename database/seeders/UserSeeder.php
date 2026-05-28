<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@elo.com',
            'password' => 'password',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'user@elo.com',
            'password' => 'password',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);
    }
}
