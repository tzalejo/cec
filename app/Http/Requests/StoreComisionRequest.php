<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComisionRequest extends FormRequest
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
            'comisionNombre'    => 'required|min:3|max:150',
            'comisionHorario'   => 'required|min:3|max:150',
            'comisionFI'        => 'required|date|min:2000-01-01',
            'comisionFF'        => '', # no la necesito validar porque se calcula
            'cursoId'           => 'required|numeric',
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
            //
            'comisionNombre.required'       => 'El Nombre del comision es requerido',
            'comisionNombre.min'            => 'La cantidad min caracteres no son lo establecido, Verifique.',
            'comisionNombre.max'            => 'La cantidad max caracteres no son lo establecido, Verifique.',
            'comisionHorario.required'      => 'El Horarios es requerido',
            'comisionHorario.min'           => 'La cantidad min caracteres no son lo establecido, Verifique.',
            'comisionHorario.max'           => 'La cantidad max caracteres no son lo establecido, Verifique.',
            'comisionFI.required'           => 'La Fecha de Inicio es requerido',
            'comisionFI.min'                => 'La Fecha de Inicio no es valida',
            'comisionFI.date'               => 'La Fecha de Inicio no es valida',
            'cursoId.required'              => 'El curso es requerido',
        ];
    }

    
}
