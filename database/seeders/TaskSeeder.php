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
        // for($day = 1; $day <= 3; $day++){
        //     $formattedDay = sprintf('%02d', $day);

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-11-2023',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-11-2023',
        //         'deadline' => '2023-11-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '1',
        //         'user_id' => 1,
        //         'customer_id' => 1,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-12-2023',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-12-2023',
        //         'deadline' => '2023-12-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '2',
        //         'user_id' => 1,
        //         'customer_id' => 1,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-01-2024',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-01-2024',
        //         'deadline' => '2024-01-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '3',
        //         'user_id' => 1,
        //         'customer_id' => 1,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);

        //     // Microsoft

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-11-2023',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-11-2023',
        //         'deadline' => '2023-11-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '4',
        //         'user_id' => 1,
        //         'customer_id' => 4,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-12-2023',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-12-2023',
        //         'deadline' => '2023-12-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '5',
        //         'user_id' => 1,
        //         'customer_id' => 4,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-01-2024',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-01-2024',
        //         'deadline' => '2024-01-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '6',
        //         'user_id' => 1,
        //         'customer_id' => 4,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);

        //     // Apple

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-11-2023',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-11-2023',
        //         'deadline' => '2023-11-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '7',
        //         'user_id' => 1,
        //         'customer_id' => 3,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-12-2023',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-12-2023',
        //         'deadline' => '2023-12-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '8',
        //         'user_id' => 1,
        //         'customer_id' => 3,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);

        //     Task::create([
        //         'title' => 'Post ' . $formattedDay . '-01-2024',
        //         'description' => 'Instagram post voor de dag ' . $formattedDay . '-01-2024',
        //         'deadline' => '2024-01-' . $formattedDay,
        //         'status' => 'pending',
        //         'project_id' => '9',
        //         'user_id' => 1,
        //         'customer_id' => 3,
        //         'assigned_to' => json_encode([2, 4]),
        //     ]);
        // }
    }
}
