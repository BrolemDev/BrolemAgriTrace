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

    public static function getBranchs()
    {
        $branchs = self::all();

        $data = [];
        foreach ($branchs as $row) {
            $data[] = [
                'id' => $row->id_branch,
                'anexo' => $row->anexo_branch,
                'name' => $row->name_branch ,
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
}
