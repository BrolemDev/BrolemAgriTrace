<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\RolesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::controller(UserController::class)->group(function ($route) {

    Route::get('/Usuarios', 'index')->name('users');
    Route::post('/Usuarios/roles', 'getRoles');
    Route::post('/newUser', 'new');
    Route::get('/Users', 'show');
    Route::post('/updateUser', 'update');
});

Route::controller(OfficesController::class)->group(function ($route) {

    Route::get('/Oficinas', 'index')->name('Oficinas');
    Route::get('/Offices', 'show');
    Route::post('/insertOffice', 'insert');
    Route::post('/status', 'updateStatus');
    Route::post('/updateOffice', 'update');
});

Route::controller(RolesController::class)->group(function ($route) {

    Route::get('/Roles', 'index')->name('Roles');
    Route::get('/showRoles', 'show');
    Route::post('/insertRol', 'insert');
    Route::post('/statusRol', 'updateStatus');
    Route::post('/updateRol', 'update');
});
