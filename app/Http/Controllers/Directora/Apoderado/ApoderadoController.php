<?php

namespace App\Http\Controllers\Directora\Apoderado;

use App\Http\Controllers\Controller;
use App\Models\Apoderado;
use Illuminate\Http\Request;

class ApoderadoController extends Controller
{
    //TODO: Crear nuevo apoderado
    public function crearApoderado(Request $request)
    {
        $validacion_datos = $request->validate([
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'telefono' => 'required|max:60|unique:users|int',
        ], [
            //! VALIDACIONES
            'nombres.required' => 'El campo nombres es requerido',
            'apellidos.required' => 'El campo apellidos es requerido',
            'telefono.required' => 'El campo telefono es requerido',
            'telefono.unique' => 'El telefono ya esta ocupado',
        ]);

        $apoderado = $validacion_datos;
        $apoderado = Apoderado::create($apoderado);

        return response()->json([
            'message' => 'Apoderado registrado exitosamente',
            'apoderado' => $apoderado
        ], 200);
    }

    //TODO: Obtener todos los apoderados
    public function obtenerApoderados(Request $request)
    {
        $apoderados = Apoderado::all();
        if ($apoderados->count() > 0) {
            return response()->json([
                'apoderados' => $apoderados
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay apoderados registrados.'
            ], 200);
        }
    }

    //TODO: Buscar apoderado
    public function buscarApoderado(Request $request, $id)
    {
        $apoderado = Apoderado::find($id);
        if ($apoderado) {
            return response()->json([
                'message' => 'Apoderado encontrado',
                'apoderado' => $apoderado
            ], 200);
        } else {
            return response()->json([
                'message' => 'Apoderado no encontrado'
            ], 404);
        }
    }

    //TODO: Modificar apoderado
    public function modificarApoderado(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'telefono' => 'required|max:60|unique:users|int',
        ], [
            //! VALIDACIONES
            'nombres.required' => 'El campo nombres es requerido',
            'apellidos.required' => 'El campo apellidos es requerido',
            'telefono.required' => 'El campo telefono es requerido',
            'telefono.unique' => 'El telefono ya esta ocupado',
        ]);

        $apoderado = Apoderado::find($id);
        if (!$apoderado) {
            return response()->json(['error' => 'El apoderado no existe'], 404);
        }
        $apoderado->update($validacion_datos);
        return response()->json(['message' => 'Apoderado modificado exitosamente', 'apoderado' => $apoderado], 200);
    }

    //TODO: Eliminar apoderado
    public function eliminarApoderado($id)
    {
        $apoderado = Apoderado::find($id);
        if (!$apoderado) {
            return response()->json(['error' => 'El apoderado no existe'], 404);
        }
        $apoderado->delete();
        return response()->json(['message' => 'Apoderado eliminado exitosamente'], 200);
    }
}
