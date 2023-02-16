<?php

namespace App\Http\Controllers\Educadora\Alumno;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlumnoController extends Controller
{
    
    //TODO: Obtener todos los cursos
    public function obtenerAlumnos(Request $request)
    {
        $alumnos = Alumno::all();
        if ($alumnos->count() > 0) {
            return response()->json([
                'alumnos' => $alumnos
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay alumnos registrados.'
            ], 200);
        }
    }

    //TODO: Buscar curso
    public function buscarAlumno(Request $request, $id)
    {
        $alumno = Alumno::find($id);
        if ($alumno) {
            return response()->json([
                'message' => 'Alumno encontrado',
                'alumno' => $alumno
            ], 200);
        } else {
            return response()->json([
                'message' => 'Alumno no encontrado'
            ], 404);
        }
    }
}
