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
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate([
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'username' => 'admin121',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'bio' => 'This is a test bio for Admin.',
        ]);

        User::updateOrCreate([
            'first_name' => 'Test ',
            'last_name' => 'User',
            'username' => 'user123',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'bio' => 'This is a test bio for User.',
        ]);
    }
}
