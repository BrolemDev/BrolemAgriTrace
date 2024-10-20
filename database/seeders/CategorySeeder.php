<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar los datos en la tabla 'categories'
        DB::table('categories')->insert([
            [
                'code_category' => '000',
                'name_category' => 'Example Category',
                'sale_category' => '00000',
                'purchasing_category' => null, // Se puede dejar como NULL
                'img_category' => null, // Se puede dejar como NULL
                'status_category' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
