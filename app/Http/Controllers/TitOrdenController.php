<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Extent;
use App\Models\Oc\DetOrden;
use App\Models\Oc\TitOrden;
use App\Models\Settings;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TitOrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Nueva Orden de Compra";
        $data['extents'] = Extent::all();
        $data['stores'] = Branch::filterBranchesOC();

        return view('titorden.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $oc = new TitOrden(); // Crear una instancia de la clase TitOrden
        $oc->supplier_id = $request->input('doc_supplier');
        $oc->branch_id = $request->input('store');
        $oc->typeoc_id = $request->input('type_oc');
        $oc->payment_id = $request->input('payment_method');
        $oc->delivery_time = $request->input('delivery_time');
        $oc->type_money = $request->input('coin');

        if ($oc->typeoc_id == 1) {
            if (!Storage::exists('public/filesDetailsOC')) {
                Storage::makeDirectory('public/filesDetailsOC');
            }

            // Verificar y cargar archivo raw_material1
            if ($request->hasFile('raw_material1')) {
                $file1 = $request->file('raw_material1');
                $filename1 = time() . '_raw_material1.' . $file1->getClientOriginalExtension();
                $path1 = $file1->storeAs('filesDetailsOC', $filename1, 'public');
                $oc->raw_material1 = $path1;  // Guardar la ruta en la base de datos
            }

            // Verificar y cargar archivo raw_material2
            if ($request->hasFile('raw_material2')) {
                $file2 = $request->file('raw_material2');
                $filename2 = time() . '_raw_material2.' . $file2->getClientOriginalExtension();
                $path2 = $file2->storeAs('filesDetailsOC', $filename2, 'public');
                $oc->raw_material2 = $path2;  // Guardar la ruta en la base de datos
            }
        }
        $oc->igv_amount = 0;
        $oc->total_amount = 0;
        $oc->observation_oc = $request->input('observation');
        $oc->save();

        $id = $oc->id_orden;

        $products = json_decode($request->input('tableData'), true);

        // Inicializar una variable para acumular el precio total
        $totalPrice = 0;

        // Iterar sobre cada producto en tableData y guardarlo en det_orden
        foreach ($products as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            DetOrden::create([
                'id_orden' => $id, // ID de la orden principal
                'product_id' => $item['id'], // ID del producto
                'description' => $item['description'], // Descripción del producto
                'quantity' => $item['quantity'], // Cantidad
                'unit_of_measure' => $item['unit'], // Unidad de medida
                'price' => $item['price'], // Precio
            ]);
        }
        $igvAmount = $totalPrice * 0.18;

        $order = TitOrden::find($id);
        $order->igv_amount = $igvAmount;
        $order->total_amount = $totalPrice;
        $order->save();


        return response()->json(['icon' => 'success', 'message' => 'Orden de compra agregada correctamente', 'id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function detailAttachment($id)
    {
        $title = 'Productos de Orden';
        $order = TitOrden::find($id);
        $supplier = Supplier::find($order->supplier_id);
        $setting = Settings::with('sunatCodeUbigeo')->first();
        $ubigeo = $setting->sunatCodeUbigeo;

        return view('titorden.attachments', compact('title', 'order', 'supplier','setting','ubigeo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function pdf()
    {
        require_once(public_path('fpdf/fpdf.php'));
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);

        // LOGO
        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Image(public_path('img/brolemlogo.png'), 20, 20, 60, 15, 'PNG');

        $pdf->SetXY(11, 39);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(70, 5, 'BROLEM COMPANY S.A.C', 0, 2, 'L');
        $pdf->Cell(70, 5, 'JR. ENRIQUE BARREDA NRO. 535', 0, 2, 'L');
        $pdf->Cell(70, 5, 'LA VICTORIA. LIMA-PERU', 0, 1, 'L');
        $pdf->Ln(5);

        //ORDEN DE COMPRA
        $pdf->SetXY(132, 25);
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->Cell(85, 8, 'Orden de Compra', 0, 2, 'C');

        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->SetXY(142, 40);
        $pdf->Cell(85, 5, 'OC-002-029', 0, 1, 'C');
        $pdf->SetXY(135, 45);
        $pdf->Cell(85, 5, 'FECHA: 25/03/2023', 0, 1, 'C');



        // DIRECCION DE LLEGADA
        $pdf->SetXY(110, 60);
        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->Cell(30, 10, 'ENVIE A', 0, 2, 'L');
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->Cell(10, 5, 'JR. FRANCIA 1873.URB SAN PABLO.', 0, 2, 'L');
        $pdf->Cell(10, 5, 'LA VICTORIA -LIMA', 0, 1, 'L');

        //PROVEEDOR
        $pdf->SetXY(11, 60);
        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->Cell(30, 10, 'PROVEEDOR', 0, 2, 'L');

        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->Cell(10, 5, 'ROYCA INVERSIONES S.A.C.', 0, 2, 'L');
        $pdf->Cell(10, 5, 'RUC: 20606691760', 0, 2, 'L');
        $pdf->Cell(10, 5, 'REPRESENTANTE:', 0, 2, 'L');
        $pdf->Cell(10, 5, 'Del Carpio Segovia Carlos', 0, 2, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->Cell(0, 5, 'FECHA ACORDADA DE ENTREGA', 0, 2, 'L');
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->Cell(0, 5, 'HASTA 03 DIAS DESPUES DE LA OC', 0, 1, 'L');
        $pdf->Ln(8);

        $pdf->SetFont('Helvetica', 'B', 11.5);
        $pdf->Cell(11, 7, 'NUM', 1, 0, 'C');
        $pdf->Cell(70, 7, 'DESCRIPCION', 1, 0, 'C');
        $pdf->Cell(25, 7, 'CANTIDAD ', 1, 0, 'C');
        $pdf->Cell(20, 7, 'UNIDAD', 1, 0, 'C');
        $pdf->Cell(30, 7, 'P. UNITARIO', 1, 0, 'C');
        $pdf->Cell(35, 7, 'IMPORTE', 1, 1, 'C');

        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Cell(11, 7, '', 1, 0, 'C');
        $pdf->Cell(70, 7, 'SACOS DE POLIPROPILENO TEJIDO', 1, 0, 'C');
        $pdf->Cell(25, 7, '1000', 1, 0, 'C');
        $pdf->Cell(20, 7, 'unides', 1, 0, 'C');
        $pdf->Cell(30, 7, 'S/.0.9400', 1, 0, 'R');
        $pdf->Cell(35, 7, 'S/. 940.00', 1, 2, 'R');

        $pdf->SetXY(136, 127);
        $pdf->Cell(30, 7, 'SUB-TOTAL', 1, 0, 'L');
        $pdf->Cell(35, 7, 'S/. 940.00', 1, 0, 'R');

        $pdf->SetXY(136, 134);
        $pdf->Cell(30, 7, 'IGV', 1, 0, 'L');
        $pdf->Cell(35, 7, 'S/. 169.20', 1, 0, 'R');

        $pdf->SetXY(136, 141);
        $pdf->Cell(30, 7, 'TOTAL', 1, 0, 'L');
        $pdf->Cell(35, 7, 'S/. 1,109.28', 1, 1, 'R');

        $pdf->Cell(0, 7, 'IMPORTE EN LETRAS MIL CIENTO NUEVE Y 20/100 SOLES', 0, 1, 'L');
        $pdf->Ln(8);
        $pdf->Cell(70, 7, 'ORDEN DE SERVICIO RELACIONADA', 1, 1, 'L');
        $pdf->Cell(0, 7, 'SIN ORDEN RELACIONADA / ENVIAR FICHA TECNICA DEL PRODUCTO', 0, 1, 'L');
        $pdf->Ln(10);


        $pdf->Cell(70, 7, 'DATOS DE FACTURACION:', 0, 2, 'L');
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Cell(0, 4, 'BROLEM COMPAY S.A.C', 0, 2, 'L');
        $pdf->Cell(0, 4, '20517686639', 0, 2, 'L');
        $pdf->Cell(0, 4, '**PREVIA FACTURACION CONTACTAR A: JCGUERRERO@BROLEM.PE**', 0, 2, 'L');
        $pdf->Cell(0, 4, 'CELL: 981014266', 0, 2, 'L');



        //Orden de Compra
        // Generar el PDF y enviarlo al navegador
        $pdf->Output();
        exit;
    }
}
