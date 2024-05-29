<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SunatModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["01", "Transporte público"],
            ["02", "Transporte privado"],
        ];

        foreach ($data as $row) {
            DB::table('sunat_modality')->insert([
                'id_modality' => $row[0],
                'description_modality' => $row[1],
            ]);
        }
    }
}
