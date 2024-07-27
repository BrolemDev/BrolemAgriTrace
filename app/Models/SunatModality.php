<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatModality extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_modality';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'sunat_modality';
}
