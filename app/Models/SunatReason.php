<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatReason extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_reason';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'sunat_reason';
}
