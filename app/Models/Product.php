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


    public function extent()
    {
        return $this->belongsTo(Extent::class, 'extent_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function igv()
    {
        return $this->belongsTo(Sunat::class, 'igv_id');
    }
    public function detraction()
    {
        return $this->belongsTo(Detraction::class, 'detraction_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public static function getInventory()
    {
        $items = self::all();

        $data = [];
        foreach ($items as $item) {
            $data[] = [
                'id' => $item->id_product,
                'code' => $item->code_product,
                'name' => $item->name_product,
                'branch' => optional($item->branch)->name_branch,
                'category' => optional($item->category)->name_category,
                'extent' => optional($item->extent)->name_extent,
                'igv' => $item->igv_id,
                'pen' => $item->price_pen,
                'pen_igv' => $item->price_pen_igv,
                'usd' => $item->price_usd,
                'usd_igv' => $item->price_usd_igv,
                'stock' => $item->stock,
                'stock_min' => $item->stock_min,
                'detraction' => $item->detraction_id,
                'detail' => $item->detail_product,
                'status' => $item->status_product,
            ];
        }

        return $data;
    }
}
