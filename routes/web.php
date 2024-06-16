<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\GeneraOrdenesController;
use App\Http\Controllers\PensionesController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');


    Route::resource('usuarios',UsuariosController::class);
    Route::POST('/buscar_usuarios', [UsuariosController::class, 'buscar'])->name('buscar_usuarios');
    Route::get('/cambio/{id}', [UsuariosController::class, 'cambio'])->name('cambio');
    Route::POST('/contrasena/{id}', [UsuariosController::class, 'contrasena'])->name('contrasena');
    Route::get('/reiniciar/{cedula}/{id}', [UsuariosController::class, 'reiniciar'])->name('reiniciar');
    Route::get('/actualizar/{id}', [UsuariosController::class, 'actualizar'])->name('actualizar');
    Route::POST('/cambiar_password/{id}', [UsuariosController::class, 'cambiar_password'])->name('cambiar_password');
    
    Route::resource('estudiantes',EstudiantesController::class);
    Route::get('/buscar_estudiantes', [EstudiantesController::class, 'buscar'])->name('buscar_estudiantes');

    Route::resource('ordenes', GeneraOrdenesController::class);
    Route::get('/generar_ordenes',[GeneraOrdenesController::Class,'index'])->name('genera_ordenes.index'); 
    Route::post('/generarOrdenes',[GeneraOrdenesController::Class,'generarOrdenes'])->name('generarOrdenes'); 
    Route::post('/eliminarOrden', [GeneraOrdenesController::class, 'eliminarOrden'])->name('eliminarOrden');
    Route::get('/buscar_estudiante_orden', [GeneraOrdenesController::class, 'buscar_estudiante_orden'])->name('buscar_estudiante_orden');

    Route::get('/genera_ordenes.show/{secuencial}',[GeneraOrdenesController::class, 'show'])->name('genera_ordenes.show');
    Route::get('/genera_ordenes.xls/{secuencial}',[GeneraOrdenesController::class, 'genera_xls'])->name('genera_ordenes.xls');
    
    Route::get('/genera_ordenes.upload',[GeneraOrdenesController::class, 'upload'])->name('genera_ordenes.upload');
    Route::get('/genera_ordenes.report',[GeneraOrdenesController::class, 'report'])->name('genera_ordenes.report');

    Route::post('/genera_ordenes.upload_file',[GeneraOrdenesController::class, 'upload_file'])->name('genera_ordenes.upload_file');

    Route::get('/genera_ordenes.upload_show/{sec}',[GeneraOrdenesController::class, 'upload_show'])->name('genera_ordenes.upload_show');
    Route::get('/genera_ordenes.delete/{sec}',[GeneraOrdenesController::class, 'delete'])->name('genera_ordenes.delete');

    Route::get('/genera_ordenes.report',[GeneraOrdenesController::class, 'report'])->name('genera_ordenes.report');
    Route::post('/genera_ordenes.report',[GeneraOrdenesController::class, 'report'])->name('genera_ordenes.report');


    

});





Route::get('/info/{nombre}',function($nombre){
    dd('ruta info' . $nombre);
});

require __DIR__.'/auth.php';
 