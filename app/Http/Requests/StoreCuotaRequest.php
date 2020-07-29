<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuotaRequest extends FormRequest
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
            'cuotaId'               => 'required|numeric',
            'cuotaMonto'            => 'required|numeric|min:100'
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
            'cuotaId.required'      => 'La cuota es requerda, por favor verifique.',
            'cuotaId.numeric'       => 'Se espera un valor numerico, por favor verifique.',
            'cuotaMonto.required'   => 'El Monto de la cuota es requerido, por favor verifique.',
            'cuotaMonto.numeric'    => 'Se espera un valor numerico, por favor verifique.',
        ];
    }
}
