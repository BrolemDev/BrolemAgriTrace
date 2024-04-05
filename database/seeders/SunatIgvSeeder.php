<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SunatIgvSeeder extends Seeder
{
    /**
     * 
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["10", "Gravado - Operación Onerosa"],
            ["11", "[Gratuita] Gravado - Retiro por premio"],
            ["12", "[Gratuita] Gravado - Retiro por donación"],
            ["13", "[Gratuita] Gravado - Retiro"],
            ["14", "[Gratuita] Gravado - Retiro por publicidad"],
            ["15", "[Gratuita] Gravado - Bonificaciones"],
            ["16", "[Gratuita] Gravado - Retiro por entrega a trabajadores"],
            ["20", "Exonerado - Operación Onerosa"],
            ["30", "Inafecto - Operación Onerosa"],
            ["31", "[Gratuita] Inafecto - Retiro por Bonificación"],
            ["32", "[Gratuita] Inafecto - Retiro"],
            ["33", "[Gratuita] Inafecto - Retiro por Muestras Médicas"],
            ["34", "[Gratuita] Inafecto - Retiro por Convenio Colectivo"],
            ["35", "[Gratuita] Inafecto - Retiro por premio"],
            ["36", "[Gratuita] Inafecto - Retiro por publicidad"],
            ["40", "Exportación"],
            ["7152", "Gravado - ICBPER"]
        ];

        foreach ($data as $row) {
            DB::table('sunat_igv')->insert([
                'id_igv' => $row[0],
                'description_igv' => $row[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
