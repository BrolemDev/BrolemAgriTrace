<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;

class OfficesController extends Controller
{
    public function index()
    {
        $data['title'] = "Oficinas";
        return view('office', $data);
    }
    public function show()
    {
        $officesData = Office::getOffices();
        return response()->json(['data' => $officesData]);
    }
    public function insert(Request $request)
    {
        $name = $request->input('categoryTitle');
        $description = $request->input('description');

        $office = new Office();
        $office->name_office = "$name";
        $office->text_office = $description;
        $office->status_office = 1;
        $office->save();

        return response()->json([
            'message' => 'Oficina Agregado'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('categoryId');
        $name = $request->input('categoryTitle');
        $description = $request->input('description');

        $office = Office::findOrFail($id);
        $office->name_office = "$name";
        $office->text_office = $description;
        $office->save();

        return response()->json([
            'message' => 'Oficina Actualizado'
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');

            $category = Office::findOrFail($id);
            $category->status_office = $status;
            $category->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la categoría.'], 404);
        }
    }
}
