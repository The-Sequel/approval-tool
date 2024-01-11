<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'title' => 'Development',
        ]);

        Department::create([
            'title' => 'Marketing',
        ]);

        Department::create([
            'title' => 'Sales',
        ]);

        Department::create([
            'title' => 'Support',
        ]);
    }
}
