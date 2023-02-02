<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutenticacionController extends Controller
{
    //TODO: Registrarse
    public function registrarseUsuario(Request $request){
        $validacion_datos = $request->validate([
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'email' => 'required|max:60|email|unique:users|string',
            'password' => 'required|min:8|confirmed|string',
        ], [
            //! VALIDACIONES
            'nombres.required' => 'El campo nombres es requerido',
            'apellidos.required' => 'El campo apellidos es requerido',
            'email.required' => 'El campo correo es requerido',
            'email.unique' => 'El email ya esta ocupado',
            'password.required' => 'El campo contraseña es requerido',
            'password.confirmed' => 'La contraseña de confirmación no coincide',
            'email.unique' => 'El correo ya esta en uso',

        ]);

        $usuario = $validacion_datos;
        $usuario['password'] = Hash::make($request->password);
        $usuario = User::create($usuario);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'usuario' => $usuario
        ], 200);
    }


    //TODO: Iniciar sesión
    public function loginUsuario(Request $request)
    {
        $validacion_datos = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            //!VALIDACIONES
            'email.required' => 'El campo correo es requerido',
            'password.required' => 'El campo contraseña es requerido',
        ]);

        if (Auth::attempt($validacion_datos)) {
            $usuario = Auth::user();
            if ($usuario->estado == 'Habilitado') {
                $token = $usuario->createToken('token')->plainTextToken;
                $cookie = cookie('cookie_token', $token, 60 * 24);
                if ($usuario->roles == 'Directora') {
                    return response()->json(['message' => 'Te has logeado como directora', "token" => $token,], 200);
                } elseif ($usuario->roles == 'Educadora') {
                    return response()->json(['message' => 'Te has logeado como educadora', "token" => $token], 200);
                }
            } else {
                return response()->json(['error' => 'La cuenta esta desactivada, por favor contacte al soporte'], 401);
            }
        } else {
            return response()->json(['error' => 'Credenciales inválidas, por favor vuelva a intentarlo.'], 401);
        }
    }

    //TODO: Cerrar sesión
    public function logoutUsuario(Request $request)
    {
        if (auth()->check()) {
            auth()->user()->tokens()->delete();
            return response()->json([
                'msg' => 'Acabaste de cerrar sesion con el usuario ' . auth()->user()->nombres . ' ' . auth()->user()->apellidos,
            ], 200);
        } else {
            return response()->json([
                'msg' => 'No hay usuario autenticado'
            ], 401);
        }
    }
}
