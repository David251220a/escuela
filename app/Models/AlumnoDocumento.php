<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoDocumento extends Model
{
    use HasFactory;

    protected $table = 'alumno_documento';

    protected $guarded = [];

    public function concepto(){
        return $this->belongsTo(AlumnoDocumentoConcepto::class, 'concepto_id');
    }

}
