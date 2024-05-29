<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SunatPortCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sunat_portcode')->insert([
            ['id_portcode' => '019', 'description_portcode' => 'TUMBES'],
            ['id_portcode' => '028', 'description_portcode' => 'TALARA'],
            ['id_portcode' => '046', 'description_portcode' => 'PAITA'],
            ['id_portcode' => '055', 'description_portcode' => 'CHICLAYO'],
            ['id_portcode' => '082', 'description_portcode' => 'SALAVERRY'],
            ['id_portcode' => '091', 'description_portcode' => 'CHIMBOTE'],
            ['id_portcode' => '118', 'description_portcode' => 'MARÍTIMA DEL CALLAO'],
            ['id_portcode' => '127', 'description_portcode' => 'PISCO'],
            ['id_portcode' => '145', 'description_portcode' => 'MOLLENDO MATARANI'],
            ['id_portcode' => '154', 'description_portcode' => 'AREQUIPA'],
            ['id_portcode' => '163', 'description_portcode' => 'ILO'],
            ['id_portcode' => '172', 'description_portcode' => 'TACNA'],
            ['id_portcode' => '181', 'description_portcode' => 'PUNO'],
            ['id_portcode' => '190', 'description_portcode' => 'CUZCO'],
            ['id_portcode' => '217', 'description_portcode' => 'PUCALLPA'],
            ['id_portcode' => '226', 'description_portcode' => 'IQUITOS'],
            ['id_portcode' => '235', 'description_portcode' => 'AÉREA DEL CALLAO'],
            ['id_portcode' => '244', 'description_portcode' => 'POSTAL DE LIMA'],
            ['id_portcode' => '262', 'description_portcode' => 'DESAGUADERO'],
            ['id_portcode' => '271', 'description_portcode' => 'TARAPOTO'],
            ['id_portcode' => '280', 'description_portcode' => 'PUERTO MALDONADO'],
            ['id_portcode' => '299', 'description_portcode' => 'LA TINA'],
            ['id_portcode' => '884', 'description_portcode' => 'DEPENDENCIA FERROVIARIA TACNA'],
            ['id_portcode' => '893', 'description_portcode' => 'DEPENDENCIA POSTAL TACNA'],
            ['id_portcode' => '910', 'description_portcode' => 'DEPENDENCIA POSTAL AREQUIPA'],
            ['id_portcode' => '929', 'description_portcode' => 'COMPLEJO FRONTERIZO STA ROSA TACNA'],
            ['id_portcode' => '938', 'description_portcode' => 'TERMINAL TERRESTRE TACNA'],
            ['id_portcode' => '947', 'description_portcode' => 'AEROPUERTO TACNA'],
            ['id_portcode' => '956', 'description_portcode' => 'CETICOS TACNA'],
            ['id_portcode' => '965', 'description_portcode' => 'DEPENDENCIA POSTAL DE SALAVERRY'],
        ]);
    }
}
