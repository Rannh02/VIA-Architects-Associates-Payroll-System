<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Account
        User::updateOrCreate(
            ['email' => 'admin@via-architect.com'],
            [
                'name' => 'Archi. Gabriel Bryan Licao',
                'password' => bcrypt('Password@123'),
                'role' => 'admin',
            ]
        );

        // Regular User Account
        User::updateOrCreate(
            ['email' => 'user@via-architect.com'],
            [
                'name' => 'User',
                'password' => bcrypt('User@123'),
                'role' => 'user',
            ]
        );
    }
}
