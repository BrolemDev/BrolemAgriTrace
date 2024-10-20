<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Branch;
use App\Models\Product;

class BranchController extends Controller
{
    public function index()
    {
        $data['title'] = "Sucursales";
        return view('branch', $data);
    }
    public function show()
    {
        $branchData = Branch::getBranchs();
        return response()->json(['data' => $branchData]);
    }
    public function new(Request $request)
    {
        try {
            $branch = new Branch();
            $branch->anexo_branch  = $request->input("anexo");
            $branch->name_branch  = $request->input("name");
            $branch->address_branch  = $request->input("address");
            $branch->urbanzation_branch  = $request->input("urbanization");
            $branch->ubigeo_branch  = $request->input("ubigeo");
            $branch->email_branch  = $request->input("mail");
            $branch->phone_branch  = $request->input("phone");
            $branch->save();

            // Crear el producto asociado a la sucursal
            $product = new Product();
            $product->code_product = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
            $product->name_product = 'Producto Example';
            $product->branch_id = $branch->id_branch;
            $product->category_id = 1;
            $product->extent_id = 1;
            $product->igv_id = "10";
            $product->price_pen = 00.00;
            $product->price_pen_igv = 00.00;
            $product->price_usd = 00.00;
            $product->price_usd_igv = 00.00;
            $product->stock = 0;
            $product->stock_min = 0;
            $product->detail_product = 'Producto de ejemplo : ' . $request->input("name");
            $product->save();

            return response()->json(['message' => 'Sucursal Agregado Correctamente', 'status' => 200]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // El código 1062 representa un error de duplicado de clave única
                return response()->json(['message' => 'La sucursal ya existe en la base de datos', 'status' => 409]); // 409: Conflict
            } else {
                return response()->json(['message' => $e->errorInfo, 'status' =>  500]);
            }
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->input('branch');

            $branch = Branch::findOrFail($id);
            $branch->anexo_branch  = $request->input("anexo");
            $branch->name_branch  = $request->input("name");
            $branch->address_branch  = $request->input("address");
            $branch->urbanzation_branch  = $request->input("urbanization");
            $branch->ubigeo_branch  = $request->input("ubigeo");
            $branch->email_branch  = $request->input("mail");
            $branch->phone_branch  = $request->input("phone");
            $branch->save();

            return response()->json(['message' => 'Sucursal Actualizado Correctamente', 'status' => 200]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // El código 1062 representa un error de duplicado de clave única
                return response()->json(['message' => 'Contactar con administrador', 'status' => 409]); // 409: Conflict
            } else {
                return response()->json(['message' => 'Contactar con administrador', 'status' =>  500]);
            }
        }
    }

    public function status(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');

            $offer = Branch::findOrFail($id);
            $offer->status_branch = $status;
            $offer->save();

            return response()->json(['type' => 'success', 'message' => 'Estado actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => 'No se pudo Actualizar la categoria.'], 404);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        // Obtén el registro que deseas eliminar
        $record = Branch::find($id);
        if (!$record) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        $record->delete();

        return response()->json(['success' => true, 'message' => 'Proveedor eliminado correctamente']);
    }
}
