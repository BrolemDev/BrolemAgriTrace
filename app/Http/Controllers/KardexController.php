<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Kardex;
use App\Http\Requests\KardexSearchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class KardexController extends Controller
{
    public function index()
    {
        $data['title'] = "Kardex Valorizado";
        $data['branches'] = Branch::all();
        return view('kardex', $data);
    }

    public function tableKardex(Request $request)
    {
        $product = $request->input('product');
        $branch_id = $request->input('branch_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $kardex_entries = Kardex::where('product_id', $product)
            ->where('branch_id', $branch_id)
            ->whereBetween('created_at', [Carbon::parse($start_date)->startOfDay(),  Carbon::parse($end_date)->endOfDay()])
            ->get();

        return response()->json($kardex_entries);
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
