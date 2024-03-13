<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personal;
use App\Models\Office;
use App\Models\Rol;


class UserController extends Controller
{
    public function index()
    {
        $title = "Usuarios";
        $offices = Office::all();
        $roles = Rol::all();
        return view('user', compact('offices', 'roles', 'title'));
    }
    public function show()
    {
        $personalData = Personal::getUsers();
        return response()->json(['data' => $personalData]);
    }

    public function getRoles(Request $request)
    {
        // Obtener los roles relacionados con el office_id proporcionado
        $roles = Rol::where('office_id', $request->input('id'))->get();

        return response()->json($roles);
    }
    public function new(Request $request)
    {
        $personal = new Personal();
        $personal->firstname = $request->input('userFirstname');
        $personal->lastname = $request->input('userLastname');
        $personal->email = $request->input('userEmail');
        $personal->phone = $request->input('userContact');
        $personal->role_id = $request->input('userRol');
        $personal->office_id = $request->input('userOffice');
        $personal->status = $request->input('userStatus');
        $personal->avatar = '';
        $personal->dni = $request->input('userDNI');
        $personal->save();

        return response()->json(['message' => 'Usuario Agregado Correctamente']);
    }

    public function update(Request $request)
    {
        $userID = $request->input('userID');

        $personal = Personal::findOrFail($userID);
        $personal->firstname = $request->input('userFirstname');
        $personal->lastname = $request->input('userLastname');
        $personal->email = $request->input('userEmail');
        $personal->phone = $request->input('userContact');
        $personal->role_id = $request->input('userRol');
        $personal->office_id = $request->input('userOffice');
        $personal->status = $request->input('userStatus');
        $personal->dni = $request->input('userDNI');
        $personal->save();

        return response()->json(['message' => 'Usuario Modificado Correctamente']);
    }
}
