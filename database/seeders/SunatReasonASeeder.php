<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SunatReasonASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["01", "VENTA"],
            ["02", "COMPRA"],
            ["04", "TRASLADO ENTRE ESTABLECIMIENTOS DE LA MISMA EMPRES..."],
            ["08", "IMPORTACION"],
            ["09", "EXPORTACION"],
            ["13", "OTROS"],
            ["14", "VENTA SUJETA A CONFIRMACION DEL COMPRADOR"],
            ["18", "TRASLADO EMISOR ITINERANTE CP"],
            ["19", "TRASLADO A ZONA PRIMARIA"],
        ];

        foreach ($data as $row) {
            DB::table('sunat_reason')->insert([
                'id_reason' => $row[0],
                'description_reason' => $row[1],
            ]);
        }
    }
}
