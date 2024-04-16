<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extent extends Model
{

    use HasFactory;
    protected $table = 'sunat_extent';
    protected $primaryKey = 'id_extent';
    protected $fillable = ['id_extent', 'name_extent'];
    
}
