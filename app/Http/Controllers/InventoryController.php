<?php

namespace App\Http\Controllers;

// Libraries
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
// End of Libraries

use App\Models\Product;
use App\Models\Category;
use App\Models\Sunat;
use App\Models\Extent;
use App\Models\Detraction;

class InventoryController extends Controller
{
    public function index()
    {
        $title = "Productos/Servicios";
        $sunat = Sunat::all();
        $extents = Extent::all();
        $detractions = Detraction::all();
        $categories = Category::all();
        return view('inventory', compact('sunat', 'extents', 'detractions', 'categories', 'title'));
    }

    public function show()
    {
        $data = Product::getInventory();
        return response()->json(['data' => $data]);
    }

    public function newCode()
    {
        $unique = false;
        $code = null;
        do {
            $code = Str::upper(Str::random(7));

            $existingTicket = Product::where('code_product', $code)->first();

            if (!$existingTicket) {
                $unique = true;
            }
        } while (!$unique);

        return response()->json(['code' => $code]);
    }

    public function new(Request $request)
    {

        try {
            $product = new Product();
            $product->code_product  = $request->input("code");
            $product->name_product  = $request->input("name");
            $product->branch_id  = 1;
            $product->category_id  = $request->input("category");
            $product->extent_id  = $request->input("extent");
            $product->igv_id  = $request->input("igv");
            $product->price_pen  = $request->input("pen");
            $product->price_pen_igv  = $request->input("pen_igv");
            $product->price_usd  = $request->input("usd");
            $product->price_usd_igv  = $request->input("usd_igv");
            $product->stock  = $request->input("stock");
            $product->stock_min  = $request->input("stock_min");
            if ($request->input("detract") === 1) {
                $product->detraction_id  = $request->input("detraction_id");
            }
            $product->detail_product  = $request->input("detail");
            $product->save();

            return response()->json(['message' => 'Producto Agregado Correctamente', 'status' => 200]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json(['message' => $e->errorInfo, 'status' =>  500]);
        }
    }
}
