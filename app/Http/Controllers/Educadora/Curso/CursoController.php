<?php

namespace App\Http\Controllers\Educadora\Curso;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CursoController extends Controller
{
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
}
