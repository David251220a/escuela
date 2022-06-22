<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    use HasFactory;

    protected $table = 'alergia';

    protected $guarded = [];

public function estado(){
    return $this->belongsTo(Estado::class, 'estado_id');
}

}
