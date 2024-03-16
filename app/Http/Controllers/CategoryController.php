<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data['title'] = "Categorias";
        return view('category', $data);
    }
    public function show()
    {
        $categoryData = Category::getCategories();
        return response()->json(['data' => $categoryData]);
    }

    public function status(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');

            $offer = Category::findOrFail($id);
            $offer->status_category = $status;
            $offer->save();

            return response()->json(['type' => 'success', 'message' => 'Estado actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => 'No se pudo Actualizar la categoria.'], 404);
        }
    }
}
