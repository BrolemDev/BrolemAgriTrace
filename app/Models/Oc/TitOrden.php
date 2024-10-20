<?php

namespace App\Models\Oc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitOrden extends Model
{
    use HasFactory;

    protected $table = 'tit_orden'; // Especifica el nombre de la tabla si es diferente del nombre del modelo

    protected $primaryKey = 'id_orden'; // Asegúrate de que el campo de clave primaria sea el correcto

    protected $fillable = [
        'supplier_id',
        'typeoc_id',
        'payment_id',
        'delivery_time',
        'observation_delivery',
        'delivery_place',
        'raw_material1',
        'raw_material2',
        'type_money',
        'total_amount',
        'igv_amount',
        'observation_oc',
    ];
}
