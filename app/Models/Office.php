<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';
    protected $primaryKey = 'id_office';
    protected $fillable = ['name_office', 'text_office', 'color_office'];


    public static function getOffices()
    {
        $offices = self::all();

        $data = [];
        foreach ($offices as $office) {
            $data[] = [
                'id' => $office->id_office ,
                'name' => $office->name_office,
                'description' => $office->text_office,
                'image' => $office->color_office,
                'status' => $office->status_office,
                'created_at' => $office->created_at,
            ];
        }

        return $data;
    }
}
