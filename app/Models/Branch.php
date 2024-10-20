<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'branches';
    protected $primaryKey = 'id_branch';
    protected $fillable = ['anexo_branch', 'name_branch', 'address_branch', 'urbanzation_branch', 'ubigeo_branch', 'phone_branch', 'email_branch', 'status_branch'];

    public static function getID($name)
    {
        $branch = self::where('name_branch', $name)->first();
        if ($branch) {
            return $branch->id_branch;
        }
        // Si no se encuentra, devolver null o manejar el error según sea necesario
        return null;
    }

    public static function getBranchs()
    {
        $branchs = self::all();

        $data = [];
        foreach ($branchs as $row) {
            $data[] = [
                'id' => $row->id_branch,
                'anexo' => $row->anexo_branch,
                'name' => $row->name_branch,
                'address' => $row->address_branch,
                'urbanization' => $row->urbanzation_branch,
                'ubigeo' => $row->ubigeo_branch,
                'phone' => $row->phone_branch,
                'email' => $row->email_branch,
                'status' => $row->status_branch,
            ];
        }
        return $data;
    }
    public static function filterBranchesOC()
    {
        // Obtiene todas las sucursales
        $branchs = self::all();

        // Obtiene todos los códigos de ubigeo necesarios en una sola consulta
        $ubigeos = SunatCodeUbigeo::whereIn('codigo_ubigeo', $branchs->pluck('ubigeo_branch'))->get()->keyBy('codigo_ubigeo');

        $data = [];
        foreach ($branchs as $row) {
            // Busca el ubigeo en la colección
            $ubigeo = $ubigeos->get($row->ubigeo_branch);

            $data[] = [
                'id' => $row->id_branch,
                'anexo' => $row->anexo_branch,
                'name' => $row->name_branch,
                'address' => $row->address_branch,
                'urbanization' => $row->urbanization_branch, // Corrige este nombre si es necesario
                'ubigeo' => $ubigeo ? "{$ubigeo->departamento} - {$ubigeo->provincia} - {$ubigeo->distrito}" : 'N/A',
                'status' => $row->status_branch,
            ];
        }

        return $data;
    }
}
