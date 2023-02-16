<?php

namespace App\Http\Controllers\Educadora\Apoderado;

use App\Models\Apoderado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApoderadoController extends Controller
{
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
}
