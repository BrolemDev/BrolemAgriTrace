<?php

namespace App\Http\Controllers;

use App\Models\DeliveryGuide;
use App\Models\DeliveryGuideDetail;
use App\Models\Extent;
use App\Models\SunatCodePort;
use App\Models\SunatModality;
use App\Models\SunatReason;
use App\Traits\SUNATTrait;
use Carbon\Carbon;
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
    public function create(Request $request)
    {
        $guide = new DeliveryGuide();
        $guide->reason_id = $request->input('motive_transfer');
        $guide->modality_id = $request->input('mode_transfer');
        $guide->portcode_id = $request->input('port_transfer');
        $guide->ruc_destiny = $request->input('ruc_destiny');
        $guide->reason_destiny = $request->input('reason_destiny');
        $guide->email_destiny = $request->input('email_destiny');
        $guide->init_transfer = Carbon::createFromFormat('d/m/Y', $request->input('init_transfer'))->format('Y-m-d');
        $guide->weight_transfer = $request->input('weight_transfer');
        $guide->package_transfer = $request->input('package_transfer');
        $guide->container_transfer = $request->input('container_transfer');
        $guide->doc_transport = $request->input('doc_transport');
        $guide->number_transport = $request->input('number_transport');
        $guide->names_transport = $request->input('names_transport');
        $guide->plate_transport = $request->input('plate_transport');
        $guide->address_point = $request->input('address_point');
        $guide->address_destiny = $request->input('address_arrival');
        $guide->ubigeo_origin = $request->input('ubigeo_origin');
        $guide->ubigeo_destiny = $request->input('ubigeo_destiny');
        $guide->save();

        $tableData = json_decode($request->input('tableData'), true);

        foreach ($tableData as $data) {
            DeliveryGuideDetail::create([
                'delivery_guide_id' => $guide->id,
                'product_id' => $data['id'],
                'code' => $data['code'],
                'name' => $data['name'],
                'description' => $data['description'],
                'unit' => $data['unit'],
                'weight' => $data['weight'],
                'quantity' => $data['quantity'],
            ]);
        }


        return response()->json(['icon' => 'success', 'message' => 'Guía de remision Agregada Correctamente', 'status' => 200, 'url' => '/GuiaRemisionPdf/' . $guide->id]);
    }

    public function pdf()
    {
        require_once(public_path('fpdf/fpdf.php'));

        // Crear una instancia de FPDF
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Aqui trabajaras');

        // Evitar cualquier salida antes de generar el PDF
        ob_clean();

        // Generar el PDF y enviarlo al navegador
        $pdf->Output();
        exit;
    }
}
