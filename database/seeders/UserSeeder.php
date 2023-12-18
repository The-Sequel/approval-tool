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
            'name' => 'Silvin Customer 1',
            'email' => 'stage@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'customer_id' => 1,
            'color' => 'green',
            'department_id' => 2,
        ]);

        User::create([
            'name' => 'Silvin Customer 2',
            'email' => 'stage2@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'customer_id' => 1,
            'color' => 'green',
            'department_id' => 2,
        ]);

        User::create([
            'name' => 'Silvin Customer 3',
            'email' => 'stage3@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'customer_id' => 1,
            'color' => 'green',
            'department_id' => 2,
        ]);

        User::create([
            'name' => 'Silvin Customer 4',
            'email' => 'stage4@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'customer_id' => 1,
            'color' => 'green',
            'department_id' => 2,
        ]);

        User::create([
            'name' => 'Silvin Customer 5',
            'email' => 'stage5@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'customer_id' => 1,
            'color' => 'green',
            'department_id' => 2,
        ]);
        
        User::create([
            'name' => 'Silvin Customer 6',
            'email' => 'stage6@thesequel.nl',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'customer_id' => 1,
            'color' => 'green',
            'department_id' => 2,
        ]);
    }
}
