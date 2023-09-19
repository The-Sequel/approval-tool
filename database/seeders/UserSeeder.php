<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Silvin van Haestregt',
            'email' => 'silvinvanhaestregt@outlook.com',
            'password' => bcrypt('password'),
            'role_id' => 1, // admin
        ]);
    }
}
