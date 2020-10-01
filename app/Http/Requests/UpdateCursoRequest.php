<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCursoRequest extends FormRequest
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
     * sometimes: Validar cuando está presente
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'cursoNombre'       => 'required|min:2|max:100',
            'cursoNroCuota'     => 'required|numeric|max:48',
            'cursoCostoMes'     => 'required|numeric',
            'cursoInscripcion'  => 'required|numeric',
        ];
    }
}
