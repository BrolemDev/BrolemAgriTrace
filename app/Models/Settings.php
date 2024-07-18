<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = ['ruc', 'reason', 'ecommerce', 'phone', 'email', 'ubigeo', 'urbanization', 'address'];

    public function sunatCodeUbigeo()
    {
        return $this->belongsTo(sunatCodeUbigeo::class, 'ubigeo');
    }
}
