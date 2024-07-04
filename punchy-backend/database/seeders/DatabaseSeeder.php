<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Febe',
            'last_name' => 'De Brandt',
            'email' => 'febe@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}