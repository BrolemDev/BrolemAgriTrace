<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatReason extends Model
{
    use HasFactory;
    protected $table = 'sunat_reason';
    protected $primaryKey = 'id_reason';
}
