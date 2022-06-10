<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobroMatriculaCuota extends Model
{
    use HasFactory;

    protected $table = 'cobro_matricula_cuota';

    protected $guarded = [];

    public function cobros(){
        return $this->belongsTo(Cobro::class, 'cobro_id');
    }

    public function matricula_cuota(){
        return $this->belongsTo(Matricula_Cuota::class, 'matricula_cuota_id');
    }


}
