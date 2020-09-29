<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreEstudianteRequest extends FormRequest
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
            'estudianteNombre'      => 'required|min:3|max:50',
            'estudianteApellido'    => 'required|min:3|max:50',
            'estudianteDNI'         => ['required','numeric',Rule::unique('estudiantes', 'estudianteDNI')], // 'required|numeric', //required|unique:estudiantes,estudianteDNI //
            'estudianteDomicilio'   => 'required|max:100',
            'estudianteEmail'       => ['required','email','max:100',Rule::unique('estudiantes', 'estudianteEmail')],    // 'estudianteEmail'       => 'required|email',
            'estudianteTelefono'    => 'max:50',
            'estudianteLocalidad'   => 'required|max:100',
            'estudianteNacimiento'  => 'required|date',
            'estudianteFoto'        => 'sometimes|required'
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
            'estudianteDNI.required'        => 'El DNI del estudiante es requerido',
            'estudianteDNI.unique'          => 'El DNI del estudiante ya existe',
            'estudianteNombre.required'     => 'El Nombre del estudiante es requerido',
            'estudianteApellido.required'   => 'El Apellido del estudiante es requerido',
            'estudianteDomicilio.required'  => 'El Domicilio del estudiante es requerido',
            'estudianteLocalidad.required'  => 'El Localidad del estudiante es requerido',
            'estudianteNacimiento.required' => 'El Nacimiento del estudiante es requerido',
            'estudianteEmail.email'         => 'El Email es incorrecto, verifique el formato example@mail.com',
            'estudianteEmail.unique'        => 'El Email del estudiante ya esta registrado, verifique',
        ];
    }
}
