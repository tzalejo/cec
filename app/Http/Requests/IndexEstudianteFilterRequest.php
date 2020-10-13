<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexEstudianteFilterRequest extends FormRequest
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
            // 'dni' => 'integer'
        ];
    }

    public function messages()
    {
        return[
            // 'dni.integer'       => 'El DNI es numerico'
        ];
    }

    public function getDni()
    {
        return $this->get('dni');
    }

    public function getApellido()
    {
        return $this->get('apellido');
    }
}
