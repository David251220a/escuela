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

    public function madre(){
        return $this->belongsTo(Madre::class, 'madre_id');
    }

    public function padre(){
        return $this->belongsTo(Padre::class, 'padre_id');
    }

    public function encargado()
    {
        return $this->belongsTo(Encargado::class, 'encargado_id');
    }

    public function encargado1()
    {
        return $this->belongsTo(Encargado::class, 'encargado_id_1');
    }

    public function encargado2()
    {
        return $this->belongsTo(Encargado::class, 'encargado_id_2');
    }

    public function encargado3()
    {
        return $this->belongsTo(Encargado::class, 'encargado_id_3');
    }

    public function documentos(){
        return $this->hasMany(AlumnoDocumento::class, 'alumno_id');
    }

}
