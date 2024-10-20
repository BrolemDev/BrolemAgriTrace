<?php

namespace App\Models;

use App\Models\Reception\Reception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatTypeDocument extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_doc';
    protected $table = 'sunat_typedocument';
    public $incrementing = false;
    protected $keyType = 'string';
    
    public function receptions()
    {
        return $this->hasMany(Reception::class, 'doc_id', 'id_doc');
    }
}
