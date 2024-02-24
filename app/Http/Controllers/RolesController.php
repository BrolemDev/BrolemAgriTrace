<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Rol;

class RolesController extends Controller
{
    public function index()
    {
        $data['title'] = "Roles";
        $data['offices'] = Office::all();
        return view('rol', $data);
    }
    public function show()
    {
        $rolesData = Rol::getRoles();
        return response()->json(['data' => $rolesData]);
    }
    public function insert(Request $request)
    {
        $name = $request->input('categoryTitle');
        $rol = $request->input('rol_id');
        $description = $request->input('description');

        $office = new Rol();
        $office->name_rol = "$name";
        $office->descr_rol = $description;
        $office->office_id  = $rol;
        $office->status_rol = 1;
        $office->save();

        return response()->json([
            'message' => 'Rol Agregado'
        ]);
    }
    public function updateStatus(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');

            $category = Rol::findOrFail($id);
            $category->status_rol = $status;
            $category->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'No se pudo encontrar la categoría.'], 404);
        }
    }
    public function update(Request $request)
    {
        $id = $request->input('categoryId');

        $rol = Rol::findOrFail($id);
        $rol->name_rol = $request->input('categoryTitle');
        $rol->descr_rol  = $request->input('description');
        $rol->office_id  = $request->input('rol_id');
        $rol->save();

        return response()->json([
            'message' => 'Rol Actualizado'
        ]);
    }
}
