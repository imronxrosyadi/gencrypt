<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'Genda Maiga',
            'username' => 'genda',
            'email' => 'genda@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
