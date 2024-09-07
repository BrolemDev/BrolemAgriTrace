<?php

namespace App\Models\Reception;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = 'reception_images';
    protected $fillable = [
        'reception_id',
        'image_path',
    ];
}
