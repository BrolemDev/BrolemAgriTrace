<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatCodePort extends Model
{
    use HasFactory;
    protected $table = 'sunat_portcode';
    protected $primaryKey = 'id_portcode';
}
