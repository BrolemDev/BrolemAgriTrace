<?php

namespace App\Http\Controllers;

use App\Models\Extent;
use App\Models\SunatCodePort;
use App\Models\SunatModality;
use App\Models\SunatReason;
use App\Traits\SUNATTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransfersController extends Controller
{
    use SUNATTrait;
    public function index()
    {
        $data['title'] = "Traslados";
        return view('transfer.transfers', $data);
    }

    public function new()
    {

        $data['title'] = "Nueva Guia de Remision";
        $data['extents'] = Extent::all();
        $data['modalities'] = SunatModality::all();
        $data['reasons'] = SunatReason::all();
        $data['ports'] = SunatCodePort::all();

        return view('transfer.newTransfer', $data);
    }

    public function getDoc(Request $request)
    {
        $doc = $request->input('doc');
        $number = $request->input('number');
        $resultado = $this->searchRUC($doc, $number);

        if ($doc == "6") {
            // Manejo de respuesta para RUC
            if (isset($resultado['razonSocial']) && $resultado['estado'] === 'ACTIVO' && $resultado['condicion'] === 'HABIDO') {
                return response()->json([
                    'status' => 'success',
                    'data' => $resultado,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El RUC no está ACTIVO o HABIDO.',
                ]);
            }
        } else if ($doc == "1") {
            // Manejo de respuesta para DNI
            return response()->json([
                'status' => 'success',
                'data' => $resultado,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tipo de documento no válido.',
            ]);
        }
    }
}
