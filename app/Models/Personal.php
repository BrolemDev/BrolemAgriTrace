<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personal';
    protected $primaryKey = 'id_personal';
    protected $fillable = ['firstname', 'lastname', 'email', 'phone', 'role_id', 'office_id', 'status', 'avatar', 'dni'];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }

    public static function getUsers()
    {
        $users = self::all();

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id_personal,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email ,
                'phone' => $user->phone,
                'dni' => $user->dni,
                'avatar' => $user->avatar,
                'status' => $user->status,  
                'office' => optional($user->office)->name_office,
                'office_id' => optional($user->office)->id_office,
                'rol' => optional($user->rol)->name_rol,
                'rol_id' => optional($user->rol)->id_rol,
            ];
        }

        return $data;
    }
}
