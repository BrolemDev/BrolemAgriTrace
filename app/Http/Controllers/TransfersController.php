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
        $guide->link_guide = $this->generateToken(25);
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

    public function show()
    {

        $data = DeliveryGuide::guides();
        return response()->json(['data' => $data]);
    }

    public function guide($id)
    {
        $deliveryGuide = DeliveryGuide::guideData($id);

        if (!$deliveryGuide) {
            return response()->json(['error' => 'Guía de remisión no encontrada'], 404);
        }

        return response()->json($deliveryGuide);
    }

    private function generateToken($length = 25)
    {
        // Caracteres permitidos para el token
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$&*()_+=~`[]{}|;:,<>';
        $charactersLength = strlen($characters);
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }

        return $token;
    }

    public function validateGuide(Request $request)
    {
        $token = $request->query('token');
        if (empty($token)) {
            return redirect('/')->with('error', 'Token inválido.');
        }

        // Buscar la guía correspondiente al token
        $guide = DeliveryGuide::where('link_guide', $token)->first();

        if (!$guide) {
            return redirect('/')->with('error', 'Guía no encontrada.');
        }

        return view('transfer.validateTransfer', $guide);
    }

    public function pdf($id)
    {

        $deliveryGuide = DeliveryGuide::guideData($id);

        require_once(public_path('fpdf/fpdf.php'));

        $formattedId = str_pad($deliveryGuide['id'], 6, '0', STR_PAD_LEFT);
        $typeDocMap = [
            1 => 'DNI',
            6 => 'RUC'
        ];
        $documentType = $typeDocMap[$deliveryGuide['typeDoc']] ?? 'DOC.';

        // Crear una instancia de FPDF
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->SetXY(120, 10);

        $x = 120;
        $y = 15;
        $width = 80;
        $height = 25;

        $pdf->Rect($x, $y, $width, $height);

        $pdf->SetXY($x, $y + 3);
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->Cell($width, 5, 'R.U.C. ' . session('ruc'), 0, 2, 'C');
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->Cell($width, 8, 'GUIA DE REMISION', 0, 2, 'C');
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->Cell($width, 5, 'T002 - ' . $formattedId, 0, 2, 'C');
        $pdf->Ln(15);


        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Cell(35, 7, 'FECHA DE EMISION:', 1, 0, 'C');
        $pdf->Cell(40, 7, 'FECHA DE TRASLADO:', 1, 0, 'C');
        $pdf->Cell(35, 7, 'DOCS. REFERENCIA: ', 1, 0, 'C');
        $pdf->Cell(40, 7, 'MOTIVO TRASLADO:', 1, 0, 'C');
        $pdf->Cell(40, 7, 'MOD. TRANSPORTE:', 1, 1, 'C');

        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Cell(35, 8, $deliveryGuide['date'], 1, 0, 'C');
        $pdf->Cell(40, 8, $deliveryGuide['dateTransfer'], 1, 0, 'C');
        $pdf->Cell(35, 8, '', 1, 0, 'C');
        $pdf->Cell(40, 8,  $deliveryGuide['reason_name'], 1, 0, 'C');
        $pdf->Cell(40, 8,   utf8_decode($deliveryGuide['modality_name']), 1, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Cell(95, 7,  utf8_decode('DIRECCIÓN DE PARTIDA'), 1, 0, 'C');
        $pdf->Cell(95, 7, utf8_decode('DIRECCIÓN DE LLEGADA'), 1, 1, 'C');
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Cell(95, 10, utf8_decode($deliveryGuide['addressPoint']), 'LR', 0, 'C');
        $pdf->Cell(95, 10, utf8_decode($deliveryGuide['addressDestiny']), 'LR', 1, 'C');
        $pdf->Cell(95, 5, utf8_decode($deliveryGuide['ubigeo_origin']), 'LRB', 0, 'C');
        $pdf->Cell(95, 5, utf8_decode($deliveryGuide['ubigeo_destiny']), 'LRB', 1, 'C');
        $pdf->Ln(7);

        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Cell(75, 7, 'DESTINATARIO', 1, 0, 'C');
        $pdf->Cell(35, 7, $documentType . ' TRANSPORTE', 1, 0, 'C');
        $pdf->Cell(80, 7, 'RAZON SOCIAL TRANSP.', 1, 1, 'C');

        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Cell(75, 7, utf8_decode($deliveryGuide['reason']) . ' - ' . $deliveryGuide['destiny'], 1, 0, 'C');
        $pdf->Cell(35, 7, utf8_decode($deliveryGuide['transportDoc']), 1, 0, 'C');
        $pdf->Cell(80, 7, utf8_decode($deliveryGuide['transport']), 1, 1, 'C');
        $pdf->Ln(7);

        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Cell(70, 5, 'REMITIMOS A UD.(ES) EN BUENAS CONDICIONES LO SIGUIENTE:', 0, 2);
        $pdf->Cell(30, 7, 'CANT.', 1, 0, 'C');
        $pdf->Cell(85, 7, 'PRODUCTO', 1, 0, 'C');
        $pdf->Cell(45, 7, 'UNID/MED: ', 1, 0, 'C');
        $pdf->Cell(30, 7, 'PESO', 1, 1, 'C');

        $pdf->SetFont('Helvetica', '', 9);
        foreach ($deliveryGuide['details'] as $detail) {
            $pdf->Cell(30, 5, $detail['quantity'], 'L', 0, 'C');
            $pdf->Cell(85, 5, $detail['name'], 0, 0, 'L');
            $pdf->Cell(45, 5, $detail['unit'], 0, 0, 'C');
            $pdf->Cell(30, 5, $detail['weight'], 'R', 1, 'C');
        }

        $pdf->Cell(0, 7, 'Peso Bruto (KGM): ' . $deliveryGuide['weight'], 1, 1, 'L');
        $pdf->Cell(0, 7, 'Numero de Bulltos o Pallets:' . $deliveryGuide['package'], 1, 1, 'L');
        $pdf->Ln(7);

        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->SetFillColor(75, 139, 59);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 10, 'Obervacion:', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->Cell(15, 8, 'Destino:', 0, 0, 'C');


        // Evitar cualquier salida antes de generar el PDF
        ob_clean();

        // Generar el PDF y enviarlo al navegador
        $pdf->Output();
        exit;
    }
}
