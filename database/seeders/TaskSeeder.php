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
            'user_id' => '1',
        ]);
    }
}
