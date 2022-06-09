<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobroIngreso extends Model
{
    use HasFactory;

    protected $table = 'cobro_ingreso';

    protected $guarded = [];

    public function alumno(){
        return $this->belongsTo(Alumno::class, 'alumno_id', 'id');
    }

    public function ingreso_concepto(){
        return $this->belongsTo(CobroIngresoConcepto::class, 'cobro_ingreso_concepto');
    }

    public function cobros(){
        return $this->belongsTo(Cobro::class, 'cobro_id');
    }

}
