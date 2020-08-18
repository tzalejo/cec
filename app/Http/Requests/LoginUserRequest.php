<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email'         => 'required|email',
            //'userNombre'    => 'required|string',
            //'userNombre'    => 'required_without:email|string',
            'password'      => 'required|string',
            //'remember_me'   => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            //'userNombre.requered'   => 'El Usuario es requerido',
            'email.requered'        => 'El Email es requerido',
            'email.email'           => 'El Email es incorrecto, verifique el formato example@mail.com',
            'password.requered'     => 'El Password es requerido',
        ];
    }
}
