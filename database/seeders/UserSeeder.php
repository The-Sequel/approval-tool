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

        User::create([
            'name' => 'admin',
            'email' => 'admin@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 1, // admin
        ]);

        User::create([
            'name' => 'Adawosgi Ameyalli',
            'email' => 'adawosgiameyalli@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2, // customer
            'customer_id' => 1,
            'department_id' => 1,
        ]);
    }
}
