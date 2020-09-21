<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMatriculaRequest extends FormRequest
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
            'matriculaSituacion'=>'required',
            'estudianteId'      =>'required|numeric',
            'comisionId'        =>'required|numeric' ,
        ];
    }


    public function messages(){
        return [
            'matriculaSituacion.required' => 'La Situacion es requerido',
            'estudianteId.required' => 'El estudiante es requerido',
            'comisionId.required' => 'La comision es requerida',
        ];
    }
}
