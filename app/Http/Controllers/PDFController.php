<?php

namespace App\Http\Controllers;

use App\Models\Matricula_Cuota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Luecano\NumeroALetras\NumeroALetras;

class PDFController extends Controller
{

    public function imprimir_cobro_cuota($id){

        $matricula_cuota = Matricula_Cuota::where('id', $id)
        ->first();
        $formatter = new NumeroALetras();

        $PDF = PDF::loadView('documentos.comprobante_cobro_cuota', compact('matricula_cuota', 'formatter'));

        return $PDF->stream();
    }

}
