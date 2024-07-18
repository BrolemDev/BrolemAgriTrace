<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'ruc' => '12345678901',
            'reason' => 'My Company',
            'ecommerce' => 'My Ecommerce',
            'phone' => '123456789',
            'email' => 'example@example.com',
            'ubigeo' => 010101,
            'urbanization' => 'Urbanization Name',
            'address' => '123 Main St',
        ]);
    }
}
