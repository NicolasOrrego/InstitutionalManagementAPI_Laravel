<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_curso',
        'id_alumno',
        'estado',
        'fecha',
    ];

    public function cursos(){
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    public function users(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function alumnos(){
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

}
