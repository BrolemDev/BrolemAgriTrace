<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    protected $fillable = ['code_category', 'name_category', 'sale_category', 'purchasing_category', 'status_category'];

    public static function getCategories()
    {
        $categories = self::all();

        $data = [];
        foreach ($categories as $row) {
            $data[] = [
                'id' => $row->id_category,
                'code' => $row->code_category,
                'name' => $row->name_category,
                'sale' => $row->sale_category,
                'purchasing' => $row->purchasing_category,
                'image' => $row->img_category,
                'status' => $row->status_category,
            ];
        }
        return $data;
    }
}
