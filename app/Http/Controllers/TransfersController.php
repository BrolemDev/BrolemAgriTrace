<?php

namespace App\Http\Controllers;

use App\Models\Extent;
use App\Models\SunatCodePort;
use App\Models\SunatModality;
use App\Models\SunatReason;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransfersController extends Controller
{
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
}
