<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoRequest extends FormRequest
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
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'required',
            'fecha_nacimiento' => 'required',
            'foto_perfil' => 'image|mimes:jpeg,png,jpg,gif',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_madre' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_padre' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_encargado' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_encargado1' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_encargado2' => 'image|mimes:jpeg,png,jpg,gif',
            'foto_encargado3' => 'image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
