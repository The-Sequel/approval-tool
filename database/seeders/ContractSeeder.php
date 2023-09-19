<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Contract;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contract::create([
            'name' => 'Contract 1',
            'hours' => '40',
            'status' => 'active',
            'customer_id' => 1,
        ]);
    }
}
