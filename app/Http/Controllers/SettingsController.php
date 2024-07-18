<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\sunatCodeUbigeo;
use App\Providers\SettingsServiceProvider;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function index()
    {
        $title = "Configuraciones";

        $ruc = session('ruc');
        $reason = session('reason');
        $ecommerce = session('ecommerce');
        $phone = session('phone');
        $email = session('email');
        $ubigeo = session('ubigeo');
        $urbanization = session('urbanization');
        $address = session('address');

        return view('settings', compact('title', 'ruc', 'reason', 'ecommerce', 'phone', 'email', 'ubigeo', 'urbanization', 'address'));
    }

    public function update(Request $request)
    {
        // Update settings in the database
        $setting = Settings::findOrFail(1);
        $setting->ruc = $request->input('ruc');
        $setting->reason = $request->input('reason');
        $setting->ecommerce = $request->input('ecommerce');
        $setting->phone = $request->input('phone');
        $setting->email = $request->input('email');
        $setting->ubigeo = $request->input('ubigeo');
        $setting->urbanization = $request->input('urbanization');
        $setting->address = $request->input('address');
        $setting->save();

        SettingsServiceProvider::updateSessionData();


        return response()->json(['success' => true, 'icon' => 'success', 'message' => 'Configuración actualizada']);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $results = sunatCodeUbigeo::search($searchTerm)->get();

        return response()->json($results);
    }
}
