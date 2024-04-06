<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $fillable = ['code_product', 'name_product', 'branch_id', 'igv_id', 'price_pen', 'price_usd', 'stock', 'stock_min', 'detraction_id', 'detail_product'];
}
