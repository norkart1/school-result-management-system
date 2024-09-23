<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Comment this out if you're not seeding users
        // $this->call(UsersTableSeeder::class);
        
        // Only call StudentsTableSeeder if you want to seed students
        $this->call(StudentsTableSeeder::class);
    }
    
}
