<?php

namespace App\Models\Reception;

use App\Models\SunatTypeDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;
    protected $table = 'receptions';
    protected $primaryKey = 'id_receptions';
    protected $fillable = [
        'delivery_guide_id',
        'doc_id',
        'document_number',
        'first_name',
        'last_name',
        'phone_number',
        'condition',
        'observation',
    ];

    public function sunatTypeDocument()
    {
        return $this->belongsTo(SunatTypeDocument::class, 'doc_id', 'id_doc');
    }
}
