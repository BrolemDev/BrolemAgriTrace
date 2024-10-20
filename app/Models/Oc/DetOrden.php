<?php

namespace App\Models\Oc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetOrden extends Model
{
    use HasFactory;

    protected $table = 'det_orden';
    protected $primaryKey = 'id_det_orden';

    protected $fillable = [
        'id_orden',
        'product_id',
        'description',
        'quantity',
        'unit_of_measure',
        'price',
    ];
}
