<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula_Cuota extends Model
{
    use HasFactory;

    protected $table = 'matricula_cuotas';

    protected $guarded = [];

    public function cobro_cuota(){
        return $this->belongsTo(CobroMatriculaCuota::class, 'id', 'matricula_cuota_id')->orderBy('cobro_id', 'ASC');
    }

}
