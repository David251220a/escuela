<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class CobroMatricula extends Model
{
    use HasFactory;

    protected $table = 'cobro_matricula';

    protected $guarded = [];

    public function matricula(){
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }

    public function cobros(){
        return $this->belongsTo(Cobro::class, 'cobro_id');
    }
}
