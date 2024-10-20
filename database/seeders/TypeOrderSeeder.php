<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_orden')->insert([
            ['description_typeoc' => 'Materia Prima'],
            ['description_typeoc' => 'Insumos de Exportación'],
            ['description_typeoc' => 'Productos Para Calidad'],
            ['description_typeoc' => 'Productos para Administración'],
        ]);

        DB::table('type_payment')->insert([
            ['description_payment' => 'Efectivo'],
            ['description_payment' => 'Transferencia'],
        ]);
    }
}
