<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMateriaRequest extends FormRequest
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
            'materiaNombre'     => 'required|min:2|max:100',
            'materiaSeminario'  => 'required'
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
            'materiaNombre.required'    => 'El Nombre de la Materia es requerido',
            'materiaNombre.min'         => 'Los valores de longuitud son incorrectos',
            'materiaNombre.max'         => 'Los valores de longuitud son incorrectos',
            'materiaSeminario.required' => 'Tipo del Materia es requerido',
        ];
    }
}
