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
            'email' => 'silvin@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'color' => 'green'
        ]);

        User::create([
            'name' => 'Silvin Customer',
            'email' => 'stage@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'customer_id' => 1,
            'color' => 'green'
        ]);
    }
}
