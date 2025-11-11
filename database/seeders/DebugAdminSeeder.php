<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DebugAdminSeeder extends Seeder
{
    public function run(): void
    {
        echo "\n=== Verifying Admin User ===\n";
        
        $admin = User::where('email', 'admin@example.com')->first();
        
        if ($admin) {
            echo "✅ Admin user exists\n";
            echo "   Email: {$admin->email}\n";
            echo "   Name: {$admin->name}\n";
            echo "   is_admin: " . ($admin->is_admin ?? 'NULL') . "\n";
            
            // Ensure is_admin is true
            if (!$admin->is_admin) {
                $admin->update(['is_admin' => true]);
                echo "✅ Updated is_admin to true\n";
            }
        } else {
            echo "Creating admin user...\n";
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);
            echo "✅ Admin user created\n";
            echo "   Email: admin@example.com\n";
            echo "   Password: password\n";
        }
        
        echo "\n";
    }
}
