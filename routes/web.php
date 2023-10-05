<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{EmpperController, EmpresasController, EmpsucController, HomeController, PersonasController, SucaplController, SucesosController, VehiculosController, VehsucController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/homeshow/{dt}', [HomeController::class, 'show'])->name('home.show');
//Vehiculos
Route::get('/vehiculos', [VehiculosController::class, 'index'])->name('vehiculos.index');
Route::post('/vehiculos', [VehiculosController::class, 'store'])->name('vehiculos.store');
Route::delete('/vehiculos/{v}', [VehiculosController::class, 'destroy'])->name('vehiculos.destroy');
Route::put('/vehiculos/{v}', [VehiculosController::class, 'update'])->name('vehiculos.update');
//Sucesos
Route::get('/sucesos', [SucesosController::class, 'index'])->name('sucesos.index');
Route::post('/sucesos', [SucesosController::class, 'store'])->name('sucesos.store');
//Route::delete('/sucesos/{s}', [SucesosController::class, 'destroy'])->name('sucesos.destroy');
Route::put('/sucesos/{s}', [SucesosController::class, 'update'])->name('sucesos.update');
//Empresas
Route::get('/empresas', [EmpresasController::class, 'index'])->name('empresas.index');
Route::post('/empresas', [EmpresasController::class, 'store'])->name('empresas.store');
Route::delete('/empresas/{e}', [EmpresasController::class, 'destroy'])->name('empresas.destroy');
Route::put('/empresas/{e}', [EmpresasController::class, 'update'])->name('empresas.update');
//Personas
Route::get('/personas', [PersonasController::class, 'index'])->name('personas.index');
Route::post('/personas', [PersonasController::class, 'store'])->name('personas.store');
Route::delete('/personas/{p}', [PersonasController::class, 'destroy'])->name('personas.destroy');
Route::put('/personas/{p}', [PersonasController::class, 'update'])->name('personas.update');
//Empresas Sucesos
Route::get('/empsuc/{es}', [EmpsucController::class, 'index'])->name('empsuc.index');
Route::post('/empsuc', [EmpsucController::class, 'store'])->name('empsuc.store');
Route::delete('/empsuc/{es}', [EmpsucController::class, 'destroy'])->name('empsuc.destroy');
//Sucesos Aplicados
Route::get('/sucaplv/{sa}', [SucaplController::class, 'index'])->name('sucapl.index');
Route::get('/sucaplp/{sa}', [SucaplController::class, 'show'])->name('sucapl.show');
Route::post('/sucapl', [SucaplController::class, 'store'])->name('sucapl.store');
Route::delete('/sucapldel/{sa}', [SucaplController::class, 'destroy'])->name('sucapl.destroy');
//Empresas Personas
Route::get('/empper/{ep}', [EmpperController::class, 'index'])->name('empper.index');
Route::get('/empperp/{ep}', [EmpperController::class, 'indexper'])->name('empper.indexper');
Route::post('/empper-sh', [EmpperController::class, 'show'])->name('empper.show');
Route::post('/empper-st', [EmpperController::class, 'store'])->name('empper.store');
Route::delete('/empper/{ep}', [EmpperController::class, 'destroy'])->name('empper.destroy');
//Vehicuos Sucesos
Route::get('/vehsuc/{v}', [VehsucController::class, 'show'])->name('vehsuc.show');
Route::post('/vehsuc', [VehsucController::class, 'store'])->name('vehsuc.store');
Route::delete('/vehsuc/{vs}', [VehsucController::class, 'destroy'])->name('vehsuc.destroy');