<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Supplier;

class SupplierController extends Controller
{
    protected $hoy;

    public function __construct()
    {
        $this->hoy = Carbon::now();
    }
    public function index()
    {
        $title = "Proveedores";
        return view('supplier', compact('title'));
    }

    public function show()
    {
        $supplierData = Supplier::getSuppliers();
        return response()->json(['data' => $supplierData]);
    }

    public function searchRUC(Request $request)
    {
        $ruc = $request->input('ruc');
        $token = 'apis-token-7724.S9zmK92N7Az91aMz8i72TxaaDeis7cmp';

        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Referer' => 'https://apis.net.pe/api-consulta-ruc',
            'User-Agent' => 'laravel/guzzle',
            'Accept' => 'application/json',
        ])->get('https://api.apis.net.pe/v2/sunat/ruc', [
            'numero' => $ruc,
        ]);

        return $response->json();
    }

    public function new(Request $request)
    {
        try {
            $supplier = new Supplier();
            $supplier = new Supplier();
            $supplier->ruc_supplier  = $request->input("ruc");
            $supplier->name_supplier  = $request->input("business_name");
            $supplier->phone_supplier  = $request->input("phone");
            $supplier->address_supplier  = $request->input("address");
            $supplier->email_supplier  = $request->input("mail");
            $supplier->ubigeo  = $request->input("ubigeo");
            $supplier->status_supplier = 1;
            $supplier->save();

            return response()->json(['message' => 'Proveedor Agregado Correctamente', 'status' => 200]);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // El código 1062 representa un error de duplicado de clave única
                return response()->json(['message' => 'El proveedor ya existe en la base de datos', 'status' => 409]); // 409: Conflict
            } else {
                return response()->json(['message' => 'Error al agregar el proveedor', 'status' =>  500]);
            }
        }
    }

    public function verifyRUC(Request $request)
    {
        $id = $request->input('id');
        $supplier = Supplier::findOrFail($id);

        if ($request->input('action') == "1") {

            $supplier->verify_ruc = 1;
            $supplier->observation = $request->input("observation");
            $supplier->save();
            return response()->json(['type' => 'success', 'message' => 'RUC Validado']);
            
        } else {
            $supplier->verify_ruc = 0;
            $supplier->status_supplier = 0;
            $supplier->observation = "";
            $supplier->save();
            return response()->json(['type' => 'warning', 'message' => 'RUC Invalidado']);
        }
    }

    public function fileSanitary(Request $request)
    {
        $id = $request->input('id_file_supplier');
        $supplier = Supplier::findOrFail($id);
        $ruc = $supplier->verify_ruc;

        if ($request->input('action') == "1") {
            if ($request->hasFile('formFile')) {
                $file = $request->file('formFile');
                $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/supplier', $uniqueFileName);
                $supplier->file_sanitary = $uniqueFileName;
            } else {
                return response()->json(['type' => 'error', 'message' => 'Requerido Documento']);
            }
            $supplier->verify_sanitary = 1;
            if ($ruc) {
                $supplier->status_supplier = 1;
                $supplier->expiry_validate = $this->hoy->copy()->addMonths(3);
            }
            $supplier->save();
            return response()->json(['type' => 'success', 'message' => 'Registro Guardado']);
        } else {
            Storage::disk('public')->delete('supplier/' . $request->input('file_name'));
            $supplier->file_sanitary = "";
            $supplier->verify_sanitary = 0;
            $supplier->status_supplier = 0;
            $supplier->save();
            return response()->json(['type' => 'info', 'message' => 'Documento Invalidado']);
        }
    }
}
