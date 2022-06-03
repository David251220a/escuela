<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cedula' => 'required',
            'grado' => 'required|gt:1',
            'turno' => 'required|gt:1',
            'matricula' => 'required|gt:0',
            'monto_cuota' => 'required|gt:0',
            'fecha_inicio' => 'required',
            'cantidad_cuota' => 'required|gt:0',
            'fecha_cuota' => 'required'

        ];
    }
}
