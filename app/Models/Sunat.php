<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunat extends Model
{
    use HasFactory;
    protected $table = 'sunat_igv';
    protected $primaryKey = 'id_igv';
}

class Extent extends Model
{

    use HasFactory;
    protected $table = 'sunat_extent';
    protected $primaryKey = 'id_extent';

}

class Detraction extends Model
{

    use HasFactory;
    protected $table = 'sunat_detraction';
    protected $primaryKey = 'id_detraction';
    
}
