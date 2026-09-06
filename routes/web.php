<?php 

use Lib\Route;

//use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\DashboardController;
use App\Controllers\PacientesController;
use App\Controllers\HistorialController;

Route::get('/', [LoginController::class, 'index']);

Route::get('/dashboard', [DashboardController::class , 'index']);

Route::post('/auth/verificar' , [LoginController::class , 'verificar_credenciales']);

Route::get('/logout' , [LoginController::class , 'cerrar_sesion']);

Route::get('/clientesD', [ClientesController::class, 'index2']); //el douplicado

Route::get('/clientes', [ClientesController::class, 'index']); 

Route::post('/clientes/obtener_clientes', [ClientesController::class, 'obtener_clientes']);


// -------Rutas para vistas----------
Route::get('/pacientes', [PacientesController::class, 'index']);

Route::get('/historial', [HistorialController::class, 'index']);


// -------Rutas para  registros ---------
//Pacientes:
Route::post('/pacientes/obtener_pacientes', [PacientesController::class, 'obtener_pacientes']);

Route::post('/pacientes/editar', [PacientesController::class, 'editar']);

Route::post('/pacientes/agregar', [PacientesController::class , 'agregar']);

Route::post('/pacientes/eliminar', [PacientesController::class , 'eliminar']);

//Historial:
Route::post('/historial/obtener_historial', [HistorialController::class, 'obtener_historial']);



Route::dispatch();