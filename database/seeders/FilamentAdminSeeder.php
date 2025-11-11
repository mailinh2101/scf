<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FilamentAdminSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user for Filament. Update email/password after first login.
        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
    }
}
