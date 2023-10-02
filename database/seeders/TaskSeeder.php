<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Taak 1',
            'description' => 'Dit is een taak',
            'deadline' => '2021-09-08',
            'project_id' => '1',
            'department_id' => 1,
            'user_id' => '1',
            'customer_id' => '1',
        ]);

        Task::create([
            'title' => 'Taak 2',
            'description' => 'Dit is een taak',
            'deadline' => '2021-09-08',
            'project_id' => '1',
            'department_id' => 1,
            'user_id' => '1',
            'customer_id' => '1',
        ]);

        Task::create([
            'title' => 'Instagram post',
            'description' => 'Plaats een instagram post voor ons bedrijf',
            'deadline' => '2021-09-08',
            'project_id' => '2',
            'department_id' => 2,
            'image' => 'uploads/instagram-apple.png',
            'user_id' => '1',
            'customer_id' => '1',
        ]);
    }
}
