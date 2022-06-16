<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matricula';

    protected $guarded = [];

    public function alumnos(){
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function grado(){
        return $this->belongsTo(Grado::class, 'grado_id');
    }

    public function turno(){
        return $this->belongsTo(Turno::class, 'turno_id');
    }

    public function ciclo(){
        return $this->belongsTo(Ciclo::class, 'ciclo_id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cuotas(){
        return $this->hasMany(Matricula_Cuota::class, 'matricula_id');
    }

    public function cobro_matricula(){
        return $this->hasMany(CobroMatricula::class, 'matricula_id')->orderBy('id', 'ASC');
    }

    public function cobro_matricula_cuota(){
        return $this->hasMany(CobroMatriculaCuota::class, 'matricula_id')->orderBy('id', 'ASC');
    }


    public function matricula_estado(){
        return $this->belongsTo(MatriculaEstado::class, 'matricula_estado_id');
    }

}
