<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Matricula_Cuota;
use App\Models\Turno;
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

    public function alumno_grado_turno($search_grado, $search_turno)
    {
        $alumno = Alumno::where('grado_id', $search_grado)
        ->where('turno_id', $search_turno)
        ->paginate(10);
        $grado = Grado::find($search_grado);
        $turno = Turno::find($search_turno);

        $PDF = PDF::loadView('documentos.consulta_grado_turno', compact('alumno', 'turno', 'grado'));

        return $PDF->stream();
    }

}
