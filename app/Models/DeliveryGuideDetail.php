<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryGuideDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_guide_id',
        'product_id',
        'code',
        'name',
        'description',
        'unit',
        'weight',
        'quantity',
    ];

    public function deliveryGuide()
    {
        return $this->belongsTo(DeliveryGuide::class);
    }
}
