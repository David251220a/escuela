<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    use HasFactory;

    protected $table = 'cobro';

    protected $guarded = [];

    public function cobro_matricula(){
        return $this->hasMany(CobroMatricula::class, 'cobro_id');
    }

    public function cobro_matricula_cuota(){
        return $this->hasMany(CobroMatriculaCuota::class, 'cobro_id');
    }

    public function cobro_ingreso(){
        return $this->hasMany(CobroIngreso::class, 'cobro_id');
    }

    public function tipo_cobro(){
        return $this->belongsTo(CobroConcepto::class, 'cobro_concepto_id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id');
    }

}
