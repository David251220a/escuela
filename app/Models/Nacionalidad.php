<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    use HasFactory;

    protected $table = 'nacionalidad';

    //ASIGNACIÓN MASIVA. TIENE QUE ESTAR TODOS LOS CAMPOS DE ESA TABLA.
    protected $guarded = [];

//ESTO ES PORQUE TIENE UN FOREIGN KEY CON ESTADO. OSEA TIENE UNA RELACIÓN CON OTRA TABLA.
public function estado(){
    return $this->belongsTo(Estado::class, 'estado_id');
}

}
