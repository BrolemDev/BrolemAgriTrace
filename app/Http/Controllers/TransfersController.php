<?php

namespace App\Http\Controllers;

use App\Models\Extent;
use Illuminate\Http\Request;

class TransfersController extends Controller
{
    public function index(){
        $data['title'] = "Traslados";
        return view('transfer.transfers', $data);
    }

    public function new(){
        $data['title'] = "Nueva Guia de Remision";
        $data['extents'] = Extent::all();

        return view('transfer.newTransfer', $data);
    }
}
