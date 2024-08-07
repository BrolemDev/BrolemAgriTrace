<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatCodePort extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_portcode';
    protected $table = 'sunat_portcode';
    public $incrementing = false;
    protected $keyType = 'string';
}
