<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatriculaRequest extends FormRequest
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
            'estudianteId'      => 'required',
            'comisionId'        => 'required',
            // 'montoPago'         => 'required',
        ];
    }

    public function messages(){
        return [
            'estudianteId.required' => 'El Estudiante es requerido',
            'comisionId.required' => 'La Comision es requerido',
            // 'montoPago.required' => 'El monto de la Inscripcion es requerido',
        ];
    }
}
