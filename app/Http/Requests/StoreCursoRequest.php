<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCursoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'cursoNombre'       => 'required|min:2|max:100',
            'cursoNroCuota'     => 'required|numeric|max:48',
            'cursoCostoMes'     => 'required|numeric',
            'cursoInscripcion'  => 'required|numeric',
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cursoNombre.required'        => 'El Nombre del curso es requerido',
            'cursoNroCuota.required'      => 'La cantidad de cuotas es requerido',
            'cursoNroCuota.max'           => 'La cantidad de cuotas supera el valor maximo',
            'cursoCostoMes.required'      => 'El costo por mes es requerido',
            'cursoInscripcion.required'   => 'El Apellido del estudiante es requerdio',
            'cursoNroCuota.numeric'       => 'Debe ingresar un valor numerico',
            'cursoCostoMes.numeric'       => 'Debe ingresar un valor numerico',
            'cursoInscripcion.numeric'    => 'Debe ingresar un valor numerico',
        ];
    }
}
