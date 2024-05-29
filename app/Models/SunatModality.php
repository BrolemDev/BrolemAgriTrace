<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatModality extends Model
{
    use HasFactory;
    protected $table = 'sunat_modality';
    protected $primaryKey = 'id_modality';
}
