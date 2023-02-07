<?php

use App\Http\Controllers\Directora\Apoderado\ApoderadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AutenticacionController;
use App\Http\Controllers\Directora\Usuario\UsuarioController;

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

        //TODO: CRUD usuario
        //* Crear nuevo usuario
        Route::post('/v1/directora/registrar/usuario', [UsuarioController::class, 'crearUsuario']);

        //* Ver todos los usuarios
        Route::get('/v1/directora/lista/usuarios', [UsuarioController::class, 'obtenerUsuarios']);

        //* Buscar usuario
        Route::get('/v1/directora/buscar/usuario/{id}', [UsuarioController::class, 'buscarUsuario']);

        //* Modificar usuario
        Route::put('/v1/directora/modificar/usuario/{id}', [UsuarioController::class, 'modificarUsuario']);

        //* Eliminar usuario
        Route::delete('/v1/directora/eliminar/usuario/{id}', [UsuarioController::class, 'eliminarUsuario']);
    });

       //TODO: CRUD apoderado
        //* Crear nuevo apoderado
        Route::post('/v1/directora/registrar/apoderado', [ApoderadoController::class, 'crearApoderado']);

        //* Ver todos los apoderados
        Route::get('/v1/directora/lista/apoderados', [ApoderadoController::class, 'obtenerApoderados']);

        //* Buscar apoderado
        Route::get('/v1/directora/buscar/apoderado/{id}', [ApoderadoController::class, 'buscarApoderado']);

        //* Modificar apoderado
        Route::put('/v1/directora/modificar/apoderado/{id}', [ApoderadoController::class, 'modificarApoderado']);

        //* Eliminar apoderado
        Route::delete('/v1/directora/eliminar/apoderado/{id}', [UsuarioController::class, 'eliminarApoderado']);
    });

    //TODO: Ruta educadora
    Route::middleware(['educadora'])->group(function () {
        Route::get('/v1/educadora', function () {
            return response()->json(['message' => 'Bievenido Usuario Educadora']);
        });
    });
