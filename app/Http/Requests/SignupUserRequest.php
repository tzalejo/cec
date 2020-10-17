<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SignupUserRequest extends FormRequest
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
            'userNombre'    => 'required',
            'email'         =>  ['required','email',Rule::unique('users', 'email')],
            'password'      => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages(){
        return [
            'userNombre.required'   => 'El Usuario es requerido',
            'email.required'        => 'El Email es requerido',
            'email.email'           => 'El Email es incorrecto, verifique el formato example@mail.com',
            'email.unique'          => 'El Email ya esta registrado, verifique',
        ];
    }
}
