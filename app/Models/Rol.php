<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['name_rol', 'descr_rol', 'office_id', 'text_rol', 'color_rol', 'status_rol'];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public static function getRoles()
    {
        $roles = self::all();

        $data = [];
        foreach ($roles as $rol) {
            $data[] = [
                'id' => $rol->id_rol,
                'name' => $rol->name_rol,
                'description' => $rol->descr_rol,
                'status' => $rol->status_rol,
                'text' => $rol->text_rol,
                'color' => $rol->color_rol,
                'office' => optional($rol->office)->name_office,
                'office_id' => optional($rol->office)->id_office,
            ];
        }

        return $data;
    }
}
