<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function insert(Request $request)
    {
        $category = new Category();
        $category->code_category = $request->input('codeCategory');
        $category->name_category = $request->input('nameCategory');
        $category->sale_category = $request->input('saleCategory');
        $category->purchasing_category = $request->input('purchaseCategory');
        if ($request->hasFile('imgCategory')) {
            $file = $request->file('imgCategory');
            $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/category', $uniqueFileName);
            $category->img_category = $uniqueFileName;
        }
        $category->save();

        return response()->json([
            'message' => 'Categoria Agregado'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('category');
        $category = Category::findOrFail($id);

        $category->code_category = $request->input('codeCategory');
        $category->name_category = $request->input('nameCategory');
        $category->sale_category = $request->input('saleCategory');
        $category->purchasing_category = $request->input('purchaseCategory');
        if ($request->hasFile('imgCategory')) {
            $file = $request->file('imgCategory');
            $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/category', $uniqueFileName);
            $category->img_category = $uniqueFileName;
        }
        $category->save();

        return response()->json([
            'message' => 'Categoria Modificado'
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $record = Category::find($id);
        if (!$record) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        if (!empty($record->file_sanitary)) {
            $filePath = 'public/category/' . $record->img_category;

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            } else {
                return response()->json(['success' => false, 'message' => 'El archivo no existe']);
            }
        }
        $record->delete();

        return response()->json(['success' => true, 'message' => 'Categoria eliminado correctamente']);
    }
}
