<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Detraction extends Model
{

    use HasFactory;
    protected $table = 'sunat_detraction';
    protected $primaryKey = 'id_detraction';
}