<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sunatCodeUbigeo extends Model
{
    use HasFactory;
    protected $table = 'sunat_codigoubigeo';
    protected $primaryKey = 'codigo_ubigeo';
    protected $fillable = ['departamento', 'provincia', 'distrito'];


    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('codigo_ubigeo', 'LIKE', "%{$searchTerm}%")
            ->orWhere('departamento', 'LIKE', "%{$searchTerm}%")
            ->orWhere('provincia', 'LIKE', "%{$searchTerm}%")
            ->orWhere('distrito', 'LIKE', "%{$searchTerm}%");
    }

    public static function  sessionUbigeo($id)
    {
        return self::find($id)->get();
    }
}
