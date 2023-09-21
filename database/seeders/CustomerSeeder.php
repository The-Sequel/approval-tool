<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Mac Donalds',
            'logo' => 'uploads/macdonalds.png',
            'status' => 'active',
            'debtor_number' => '123456789',
        ]);

        Customer::create([
            'name' => 'The Sequel',
            'logo' => 'uploads/thesequel.png',
            'status' => 'active',
            'debtor_number' => '987654321',
        ]);

        Customer::create([
            'name' => 'Apple',
            'logo' => 'uploads/apple.png',
            'status' => 'active',
            'debtor_number' => '123456789',
        ]);

        Customer::create([
            'name' => 'Microsoft',
            'logo' => 'uploads/microsoft.png',
            'status' => 'active',
            'debtor_number' => '987654321',
        ]);

        Customer::create([
            'name' => 'Google',
            'logo' => 'uploads/google.png',
            'status' => 'active',
            'debtor_number' => '123456789',
        ]);
    }
}
