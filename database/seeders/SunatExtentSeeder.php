<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SunatExtentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["1", "KGM", "KILOGRAMOS", "Kg"],
            ["2", "NIU", "LIBRAS", "Lb"],
            ["3", "NIU", "TONELADAS LARGAS", "Tl"],
            ["4", "NIU", "TONELADAS METRICAS", "Tm"],
            ["5", "NIU", "TONELADAS CORTAS", "Tc"],
            ["6", "GRM", "GRAMOS", "g"],
            ["7", "NIU", "UNIDADES", "Und."],
            ["8", "LTR", "LITROS", "L"],
            ["9", "NIU", "GALONES", "Galon"],
            ["10", "NIU", "BARRILES", "Barril"],
            ["11", "NIU", "LATAS", "lata"],
            ["12", "NIU", "CAJAS", "caja"],
            ["13", "NIU", "MILLARES", "m"],
            ["14", "NIU", "METROS CUBICOS", "m3"],
            ["15", "MTR", "METRO LINEAL", "m."],
            ["16", "NIU", "DOCENA", "doc"],
            ["17", "NIU", "CIENTO", "Ciento"],
            ["18", "NIU", "PAQUETE", "Pqt"],
            ["19", "NIU", "JABAS", "jaba"],
            ["20", "ZZ", "SERVICIO", "servicio"],
            ["21", "NIU", "MEDIA DOCENA", "med.doc."],
            ["22", "NIU", "FARDO", "Fdo"],
            ["23", "NIU", "MEDIA CAJA", "Med.Caj."],
            ["24", "NIU", "BOLSA", "Bolsa"],
            ["25", "NIU", "CAJETILLA", "Cajt."],
            ["26", "NIU", "PACK", "Pack"],
            ["27", "NIU", "DISPLEY", "Displey"],
            ["28", "NIU", "TIRA", "Tira"],
            ["29", "NIU", "SIXPAK", "Sixpak"],
            ["30", "NIU", "TAPER", "Taper"],
            ["31", "NIU", "FRASCO", "Fr"],
            ["32", "NIU", "VASO", "Vaso"],
            ["33", "NIU", "DISPENSADOR", "Dispens."],
            ["34", "NIU", "BANDEJA", "Bandeja"],
            ["35", "NIU", "PLATO", "Plato"],
            ["36", "NIU", "POMO", "Pomo"],
            ["37", "NIU", "SACHET", "Sachet"],
            ["38", "NIU", "MEDIO DISPLEY", "M.Displey"],
            ["39", "NIU", "BALDE", "Bal."],
            ["40", "NIU", "SACO", "Saco"],
            ["41", "NIU", "PAR", "Par"],
            ["42", "NIU", "POTE", "Pote"],
            ["43", "NIU", "ROLLO", "Rollo"],
            ["44", "NIU", "PLANCHA", "Plancha"],
            ["45", "NIU", "PIEZA", "Pieza"],
            ["46", "NIU", "BOTELLAS", "BO"],
            ["47", "NIU", "METROS CUADRADOS", "m2"],
            ["48", "NIU", "VARILLA", "varilla"],
            ["49", "NIU", "PIES", "Ft"],
            ["50", "NIU", "JUEGOS", "Juego"],
            ["51", "NIU", "CAJON", "Cajon"],
            ["52", "NIU", "GRUESA", "Gruesa"],
            ["53", "NIU", "MEDIA GRUESA", "Media Grue"],
            ["54", "NIU", "Medio Ciento", "Medio Cien"],
            ["55", "NIU", "MEDIO MILLAR", "Medio Mill"],
            ["56", "NIU", "ESTUCHE", "Estuche"],
            ["57", "NIU", "PIE CUADRADO", "Ft2"],
            ["58", "NIU", "PLIEGO", "Pliego"],
            ["59", "NIU", "RESMA", "Resma"],
            ["60", "NIU", "TONELADA", "Tonelada"],
            ["61", "NIU", "KILOGRAMOSS", "Kg"],
            ["62", "NIU", "CAPSULA", "Cap."],
            ["63", "NIU", "TABLETA", "Tabl."]
        ];

        foreach ($data as $row) {
            DB::table('sunat_extent')->insert([
                'id_extent' => $row[0],
                'code_extent' => $row[1],
                'name_extent' => $row[2],
                'symbol_extent' => $row[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
