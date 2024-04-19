<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Product;

class KardexController extends Controller
{
    public function index()
    {
        $data['title'] = "Kardex Valorizado";
        $data['branches'] = Branch::all();
        return view('kardex', $data);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        $products = Product::query()
            ->where('name_product', 'like', "%$searchTerm%")
            ->orWhere('code_product', 'like', "%$searchTerm%")
            ->get();

        return response()->json($products);
    }
}
