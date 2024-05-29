<?php

use App\Http\Controllers\BranchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\TransfersController;

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

    Route::get('/Usuarios', 'index')->name('user    s');
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
    Route::post('/statusCategory', 'status');
    Route::post('/insertCategory', 'insert');
    Route::post('/editCategory', 'update');
    Route::post('/deleteCategory', 'delete');
});

Route::controller(BranchController::class)->group(function ($route) {

    Route::get('/Sucursales', 'index')->name('Sucursales');
    Route::get('/getBranchs', 'show');
    Route::post('/insertBranch', 'new');
    Route::post('/updateBranch', 'update');
    Route::post('/statusBranch', 'status');
    Route::post('/deleteBranch', 'delete');
});

Route::controller(InventoryController::class)->group(function ($route) {

    Route::get('/Inventario', 'index')->name('Inventario');
    Route::get('/Products', 'show');
    Route::post('/newProduct', 'new');
    Route::get('/generateCode', 'newCode');
});

Route::controller(KardexController::class)->group(function ($route) {

    Route::get('/Kardex_Valorizado', 'index')->name('Kardex');
    Route::get('/search-products', 'search');
    Route::post('/table-kardex', 'tableKardex');
});

Route::controller(TransfersController::class)->group(function ($route) {

    Route::get('/Guias_Remision', 'index')->name('transfers');
    Route::get('/Generar_Guia_Remision', 'new')->name('transfers.new');
});

