<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;

    protected $table = 'seguro';

    protected $guarded = [];

    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id');
    }

}
