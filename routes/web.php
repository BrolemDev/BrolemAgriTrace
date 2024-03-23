<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;

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

Route::controller(SupplierController::class)->group(function ($route) {

    Route::get('/Proveedores', 'index')->name('Proveedores');
    Route::post('getRUC', 'searchRUC');
    Route::post('insertSupplier', 'new');
    Route::post('updateSupplier', 'update');
    Route::get('/getSuppliers', 'show');
    Route::post('/verifySupplier', 'verifyRUC');
    Route::post('/verifySanitary', 'fileSanitary');
    Route::post('/deleteSupplier', 'delete');
});

Route::controller(CategoryController::class)->group(function ($route) {

    Route::get('/Categorias', 'index')->name('Categorias');
    Route::get('/getCategories', 'show');
    Route::post('/statusCategory','status');
    Route::post('/insertCategory','insert');
    Route::post('/editCategory','update');
    Route::post('/deleteCategory', 'delete');
});
