<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AutenticacionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

//TODO: Ruta de autenticación

//* Registrarse
Route::post('/v1/registrarse', [AutenticacionController::class, 'registrarseUsuario']);

//* Iniciar sesión
Route::post('/v1/login', [AutenticacionController::class, 'loginUsuario']);

//TODO: Rutas generales 
Route::middleware(['auth:sanctum'])->group(function () {
    //* Cerrar sesión
    Route::get('/v1/logout', [AutenticacionController::class, 'logoutUsuario']);

    //TODO: Ruta directora
    Route::middleware(['directora'])->group(function () {
        Route::get('/v1/directora', function () {
            return response()->json(['message' => 'Bievenido Usuario Directora']);
        });
    });

    //TODO: Ruta educadora
    Route::middleware(['educadora'])->group(function () {
        Route::get('/v1/educadora', function () {
            return response()->json(['message' => 'Bievenido Usuario Educadora']);
        });
    });
});
