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
        // Task::create([
        //     'title' => 'Taak 1',
        //     'description' => 'Dit is een taak',
        //     'deadline' => '2021-09-08',
        //     'project_id' => '1',
        //     'department_id' => 1,
        //     'user_id' => '1',
        //     'customer_id' => '1',
        // ]);

        // Task::create([
        //     'title' => 'Taak 2',
        //     'description' => 'Dit is een taak',
        //     'deadline' => '2021-09-08',
        //     'project_id' => '1',
        //     'department_id' => 1,
        //     'user_id' => '1',
        //     'customer_id' => '1',
        // ]);

        // Task::create([
        //     'title' => 'Instagram post',
        //     'description' => 'Plaats een instagram post voor ons bedrijf',
        //     'deadline' => '2021-09-08',
        //     'project_id' => '2',
        //     'department_id' => 2,
        //     'image' => 'uploads/instagram-apple.png',
        //     'user_id' => '1',
        //     'customer_id' => '1',
        // ]);

        // Task::create([
        //     'title' => 'Taak 3',
        //     'description' => 'Dit is een taak',
        //     'deadline' => '2021-09-08',
        //     'project_id' => '1',
        //     'department_id' => 2,
        //     'user_id' => '1',
        //     'customer_id' => '1',
        // ]);

        // Task::create([
        //     'title' => 'Taak 4',
        //     'description' => 'Dit is een taak',
        //     'deadline' => '2021-09-08',
        //     'project_id' => '1',
        //     'department_id' => 3,
        //     'user_id' => '1',
        //     'customer_id' => '1',
        // ]);

        // Task::create([
        //     'title' => 'Taak 5',
        //     'description' => 'Dit is een taak',
        //     'deadline' => '2021-09-08',
        //     'project_id' => '1',
        //     'department_id' => 3,
        //     'user_id' => '1',
        //     'customer_id' => '1',
        //     'assigned_to' => '2',
        // ]);

        // Task::create([
        //     'title' => 'Taak 6',
        //     'description' => 'Dit is een taak',
        //     'deadline' => '2021-09-08',
        //     'project_id' => '1',
        //     'department_id' => 2,
        //     'user_id' => '1',
        //     'customer_id' => '1',
        // ]);


        for($day = 1; $day <= 3; $day++){
            $formattedDay = sprintf('%02d', $day);

            Task::create([
                'title' => 'Post ' . $formattedDay . '-11-2023',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-11-2023',
                'deadline' => '2023-11-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '1',
                'user_id' => 1,
                'customer_id' => 1,
                'assigned_to' => json_encode([2, 4]),
            ]);

            Task::create([
                'title' => 'Post ' . $formattedDay . '-12-2023',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-12-2023',
                'deadline' => '2023-12-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '2',
                'user_id' => 1,
                'customer_id' => 1,
                'assigned_to' => json_encode([2, 4]),
            ]);

            Task::create([
                'title' => 'Post ' . $formattedDay . '-01-2024',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-01-2024',
                'deadline' => '2024-01-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '3',
                'user_id' => 1,
                'customer_id' => 1,
                'assigned_to' => json_encode([2, 4]),
            ]);

            // Microsoft

            Task::create([
                'title' => 'Post ' . $formattedDay . '-11-2023',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-11-2023',
                'deadline' => '2023-11-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '4',
                'user_id' => 1,
                'customer_id' => 4,
                'assigned_to' => json_encode([2, 4]),
            ]);

            Task::create([
                'title' => 'Post ' . $formattedDay . '-12-2023',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-12-2023',
                'deadline' => '2023-12-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '5',
                'user_id' => 1,
                'customer_id' => 4,
                'assigned_to' => json_encode([2, 4]),
            ]);

            Task::create([
                'title' => 'Post ' . $formattedDay . '-01-2024',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-01-2024',
                'deadline' => '2024-01-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '6',
                'user_id' => 1,
                'customer_id' => 4,
                'assigned_to' => json_encode([2, 4]),
            ]);

            // Apple

            Task::create([
                'title' => 'Post ' . $formattedDay . '-11-2023',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-11-2023',
                'deadline' => '2023-11-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '7',
                'user_id' => 1,
                'customer_id' => 3,
                'assigned_to' => json_encode([2, 4]),
            ]);

            Task::create([
                'title' => 'Post ' . $formattedDay . '-12-2023',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-12-2023',
                'deadline' => '2023-12-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '8',
                'user_id' => 1,
                'customer_id' => 3,
                'assigned_to' => json_encode([2, 4]),
            ]);

            Task::create([
                'title' => 'Post ' . $formattedDay . '-01-2024',
                'description' => 'Instagram post voor de dag ' . $formattedDay . '-01-2024',
                'deadline' => '2024-01-' . $formattedDay,
                'status' => 'pending',
                'project_id' => '9',
                'user_id' => 1,
                'customer_id' => 3,
                'assigned_to' => json_encode([2, 4]),
            ]);
        }
    }
}
