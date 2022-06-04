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

}
