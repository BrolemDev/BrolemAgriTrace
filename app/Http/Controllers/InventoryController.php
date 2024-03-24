<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Rol;
class InventoryController extends Controller
{
    public function index()
    {
        $title = "Productos/Servicios";
        $offices = Office::all();
        $roles = Rol::all();
        return view('inventory', compact('offices', 'roles', 'title'));
    }
}
