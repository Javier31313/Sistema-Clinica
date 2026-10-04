<?php 

use Lib\Route;

//use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\DashboardController;
use App\Controllers\PacientesController;
use App\Controllers\HistorialController;
use App\Controllers\CitasController;

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


//Dashboard:
Route::get('/dashboard/pacientesTotales', [DashboardController::class, 'pacientesTotales']);

// -------Rutas para registros ---------

//Pacientes:
Route::post('/pacientes/obtener_pacientes', [PacientesController::class, 'obtener_pacientes']);

Route::post('/pacientes/editar', [PacientesController::class, 'editar']);

Route::post('/pacientes/agregar', [PacientesController::class , 'agregar']);

Route::post('/pacientes/eliminar', [PacientesController::class , 'eliminar']);

//Historial:
Route::post('/historial/obtener_historial', [HistorialController::class, 'obtener_historial']);

Route::post('/historial/agregar', [HistorialController::class, 'agregar']);

Route::post('/historial/editar', [HistorialController::class, 'editar']);

Route::post('/historial/eliminar', [HistorialController::class, 'eliminar']);

Route::get('/historial/findId', [HistorialController:: class, 'findId']);

//Citas:

Route::get('/citas', [CitasController::class, 'index']);

Route::post('/citas/obtener_citas', [CitasController::class, 'obtener_citas']);

Route::post('/citas/agregar', [CitasController::class, 'agregar']);

Route::post('/citas/editar', [CitasController::class, 'editar']);

Route::post('/citas/eliminar', [CitasController::class, 'eliminar']);

Route::get('/citas/obtener_pacientes', [CitasController::class, 'obtener_pacientes']);

Route::get('/pacientes/pdf', [PacientesController::class, 'generar_pdf']);


Route::dispatch();