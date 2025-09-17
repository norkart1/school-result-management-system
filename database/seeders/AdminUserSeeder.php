<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user with specified credentials
        User::updateOrCreate(
            ['name' => 'admin'], // Search criteria
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123@Admin'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
        
        $this->command->info('Admin user created/updated successfully.');
        $this->command->info('Username: admin');
        $this->command->info('Password: 123@Admin');
    }
}
