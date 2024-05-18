<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;
    protected $table = 'kardex';
    protected $primaryKey = 'id_kardex';
    protected $fillable = ['branch_id', 'personal_id', 'product_id', 'type_kardex', 'status_kardex', 'input_quantity', 'output_quantity', 'stock', 'unit_cost', 'total_cost', 'detail_kardex', 'doctype_kardex', 'docref_kardex'];


    public static function SaveMovement($branch, $product, $type, $status, $i_quantity, $o_quantity, $stock, $unit_cost, $total_cost, $detail, $doctype, $docref)
    {
        $kardex = new Kardex();
        $kardex->branch_id = $branch;
        $kardex->personal_id = 1;
        $kardex->product_id = $product;
        $kardex->type_kardex = $type;
        $kardex->status_kardex = $status;
        $kardex->input_quantity = $i_quantity;
        $kardex->output_quantity = $o_quantity;
        $kardex->stock = $stock;
        $kardex->unit_cost = $unit_cost;
        $kardex->total_cost = $total_cost;
        $kardex->detail_kardex = $detail;
        $kardex->doctype_kardex = $doctype;
        $kardex->docref_kardex = $docref;
        $kardex->save();
    }

}
