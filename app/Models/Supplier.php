<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'ruc_supplier', 'name_supplier', 'phone_supplier', 'address_supplier', 'ubigeo', 'verify_ruc', 'file_sanitary',
        'verify_sanitary', 'expiry_validate', 'expiry_sanitary', 'status_supplier'
    ];

    public static function  getSuppliers()
    {
        $suppliers = self::all();
        $data = [];
        foreach ($suppliers as $row) {
            $ubigeo = SunatCodeUbigeo::where('codigo_ubigeo', $row->ubigeo,)->first();

            $data[] = [
                'id' => $row->id_supplier,
                'name' => $row->name_supplier,
                'ruc' => $row->ruc_supplier,
                'address' => $row->address_supplier,
                'phone' => $row->phone_supplier,
                'email' => $row->email_supplier,
                'id_ubigeo' => $row->ubigeo,
                'ubigeo' => optional($ubigeo)->departamento . ' - ' . optional($ubigeo)->provincia . ' - ' . optional($ubigeo)->distrito,
                'verify' => $row->verify_ruc,
                'file' => $row->file_sanitary,
                'sanitary' => $row->verify_sanitary,
                'expiry_sanitary' => $row->expiry_sanitary,
                'expiry' => $row->expiry_validate,
                'observation' => $row->observation,
                'status' => $row->status_supplier,
                'representative' => $row->representative
            ];
        }
        return $data;
    }


    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('ruc_supplier', 'LIKE', "%{$searchTerm}%")
            ->orWhere('name_supplier', 'LIKE', "%{$searchTerm}%");
    }
}
