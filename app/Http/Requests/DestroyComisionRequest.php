<?php

namespace App\Http\Requests;

use App\Matricula;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyComisionRequest extends FormRequest
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
     * Validamos si la comision no existe: exists:comisiones,comisionId
     * y si tiene matricula: unique:matriculas,comisionId
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comisionId'     => 'required|unique:matriculas,comisionId|exists:comisiones,comisionId',
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
            'comisionId.required'       => 'La comisión es requerida',
            'comisionId.unique'         => 'La comisión contiene matricula asignadas',
            'comisionId.exists'         => 'La comisión no existe',
        ];
    }
}
