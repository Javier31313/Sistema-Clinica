<?php 

use Lib\Route;

//use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\ClientesController;
use App\Controllers\DashboardController;

Route::get('/', [LoginController::class, 'index']);

Route::get('/dashboard', [DashboardController::class , 'index']);

Route::post('/auth/verificar' , [LoginController::class , 'verificar_credenciales']);

Route::get('/logout' , [LoginController::class , 'cerrar_sesion']);

Route::get('/clientesD', [ClientesController::class, 'index2']); //el douplicado

Route::get('/clientes', [ClientesController::class, 'index']); 

Route::post('/clientes/obtener_clientes', [ClientesController::class, 'obtener_clientes']);




Route::dispatch();
