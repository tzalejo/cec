<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
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
            'pagoAbono'     => 'required|numeric',
            'cuotaId'       => 'required'
        ];
    }

    public function messages(){
        return [
            'pagoAbono.required'    => 'El importe del pago es requerido',
            'pagoAbono.numeric'     => 'El importe del pago es incorrecto',
            'cuotaId.required'      => 'La cuota es requerida'
        ];
    }
}
