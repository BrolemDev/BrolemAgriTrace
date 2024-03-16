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
        'verify_sanitary', 'expiry_validate', 'status_supplier'
    ];

    public static function  getSuppliers()
    {
        $suppliers = self::all();

        $data = [];
        foreach ($suppliers as $row) {
            $data[] = [
                'id' => $row->id_supplier,
                'name' => $row->name_supplier,
                'ruc' => $row->ruc_supplier,
                'address' => $row->address_supplier,
                'phone' => $row->phone_supplier,
                'email' => $row->email_supplier,
                'ubigeo' => $row->ubigeo,
                'verify' => $row->verify_ruc,
                'file' => $row->file_sanitary,
                'sanitary' => $row->verify_sanitary,
                'expiry' => $row->expiry_validate,
                'observation' => $row->observation,
                'status' => $row->status_supplier,
            ];
        }
        return $data;
    }
}
