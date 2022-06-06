<?php

namespace App\Http\Controllers;

use App\Models\Matricula_Cuota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{

    public function imprimir_cobro_cuota($id){

        $matricula_cuota = Matricula_Cuota::where('id', $id)
        ->first();

        $PDF = PDF::loadView('documentos.comprobante_cobro_cuota', compact('matricula_cuota'));

        return $PDF->stream();
    }

}
