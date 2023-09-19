<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'customer_id' => 1,
            'title' => 'Instagram post',
            'description' => 'Plaats een instagram post voor ons bedrijf',
            'created_by' => 'admin',
            'deadline' => '2021-09-08',
            'status' => 'pending',
        ]);
    }
}
