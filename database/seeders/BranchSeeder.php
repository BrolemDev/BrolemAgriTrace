<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            [
                'anexo_branch' => '0001',
                'name_branch' => 'Example Sucursal',
                'address_branch' => 'Address example',
                'urbanzation_branch' => 'Av',
                'ubigeo_branch' => '010101',
                'phone_branch' => null,
                'email_branch' => 'example@gmail.com',
                'status_branch' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
