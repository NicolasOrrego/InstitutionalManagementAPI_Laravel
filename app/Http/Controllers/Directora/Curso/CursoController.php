<?php

namespace App\Http\Controllers\Directora\Curso;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    //TODO: Crear nuevo curso
    public function crearCurso(Request $request)
    {
        $validacion_datos = $request->validate([
            'nombre' => 'required|max:30|min:3',
            'jornada' => 'required|max:30|min:3',
        ], [
            //! VALIDACIONES
            'nombres.required' => 'El campo nombre es requerido',
            'apellidos.required' => 'El campo jornada es requerido',
        ]);

        $curso = $validacion_datos;
        $curso = Curso::create($curso);

        return response()->json([
            'message' => 'Curso registrado exitosamente',
            'curso' => $curso
        ], 200);
    }

    //TODO: Obtener todos los cursos
    public function obtenerCursos(Request $request)
    {
        $cursos = Curso::all();
        if ($cursos->count() > 0) {
            return response()->json([
                'cursos' => $cursos
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay cursos registrados.'
            ], 200);
        }
    }

    //TODO: Buscar curso
    public function buscarCurso(Request $request, $id)
    {
        $curso = Curso::find($id);
        if ($curso) {
            return response()->json([
                'message' => 'Curso encontrado',
                'curso' => $curso
            ], 200);
        } else {
            return response()->json([
                'message' => 'Curso no encontrado'
            ], 404);
        }
    }

    //TODO: Modificar curso
    public function modificarCurso(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'nombre' => 'required|max:30|min:3',
            'jornada' => 'required|max:30|min:3',
        ], [
            //! VALIDACIONES
            'nombres.required' => 'El campo nombre es requerido',
            'apellidos.required' => 'El campo jornada es requerido',
        ]);

        $curso = Curso::find($id);
        if (!$curso) {
            return response()->json(['error' => 'El curso no existe'], 404);
        }
        $curso->update($validacion_datos);
        return response()->json(['message' => 'Curso modificado exitosamente', 'curso' => $curso], 200);
    }

    //TODO: Eliminar curso
    public function eliminarCurso($id)
    {
        $curso = Curso::find($id);
        if (!$curso) {
            return response()->json(['error' => 'El curso no existe'], 404);
        }
        $curso->delete();
        return response()->json(['message' => 'Curso eliminado exitosamente'], 200);
    }
}

