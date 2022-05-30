<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumno';

    protected $guarded = [];

    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function grado(){
        return $this->belongsTo(Grado::class, 'grado_id');
    }
}
