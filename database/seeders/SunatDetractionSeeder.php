<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SunatDetractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["001", "Azúcar", "10.00"],
            ["003", "Alcohol etílico", "10.00"],
            ["004", "Recursos hidrobiológicos", "4.00"],
            ["005", "Maíz amarillo duro", "4.00"],
            ["006", "Algodón", "10.00"],
            ["007", "Caña de azúcar", "4.00"],
            ["008", "Madera", "4.00"],
            ["009", "Arena y piedra", "10.00"],
            ["010", "Residuos, subproductos, desechos, recortes y desperdicios", "15.00"],
            ["011", "Bienes del inciso A) del Apéndice I de la Ley del IGV", "4.00"],
            ["012", "Intermediación laboral y tercerización", "12.00"],
            ["013", "Animales vivos", "10.00"],
            ["014", "Carnes y despojos comestibles", "4.00"],
            ["015", "Abonos, cueros y pieles de origen animal", "10.00"],
            ["016", "Aceite de pescado", "10.00"],
            ["017", "Harina, polvo y 'pellets' de pescado, crustáceos, moluscos y demás invertebrados acuáticos", "4.00"],
            ["018", "Embarcaciones pesqueras", "10.00"],
            ["019", "Arrendamiento de bienes muebles", "10.00"],
            ["020", "Mantenimiento y reparación de bienes muebles", "12.00"],
            ["021", "Movimiento de carga", "10.00"],
            ["022", "Otros servicios empresariales", "12.00"],
            ["023", "Leche", "1.50"],
            ["024", "Comisión mercantil", "10.00"],
            ["025", "Fabricación de bienes por encargo", "10.00"],
            ["026", "Servicio de transporte de personas", "10.00"],
            ["027", "Servicio de transporte de carga", "4.00"],
            ["029", "Algodón en rama sin desmontar", "4.00"],
            ["030", "Contratos de construcción", "4.00"],
            ["031", "Oro gravado con el IGV", "10.00"],
            ["032", "Páprika y otros frutos de los géneros capsicum o pimienta", "4.00"],
            ["033", "Espárragos", "4.00"],
            ["034", "Minerales metálicos no auríferos", "10.00"],
            ["035", "Bienes exonerados del IGV", "1.50"],
            ["036", "Oro y demás minerales metálicos exonerados del IGV", "1.50"],
            ["037", "Demás servicios gravados con el IGV", "12.00"],
            ["039", "Minerales no metálicos", "10.00"],
            ["040", "Bien inmueble gravado con IGV", "4.00"]
        ];

        foreach ($data as $row) {
            DB::table('sunat_detraction')->insert([
                'id_detraction' => $row[0],
                'decription_detraction' => $row[1],
                'percentage_detraction' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
