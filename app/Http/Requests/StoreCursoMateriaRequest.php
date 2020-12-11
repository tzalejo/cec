<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCursoMateriaRequest extends FormRequest
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
     * Valida si que  clave compuesta entre materiaId y cursoId.
     *
     * @return array
     */
    public function rules()
    {
        $materiaId = $this->get('materiaId');
        $cursoId = $this->get('cursoId');
        return [
            'cursoId' =>
                'unique:curso_materia,cursoId,NULL,id,materiaId,' . $materiaId,
            'materiaId' =>
                'unique:curso_materia,materiaId,NULL,id,cursoId,' . $cursoId,
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
            'cursoId.unique' => 'El curso ya tiene esta materia',
            'materiaId.unique' => 'La materia ya existe en el curso',
        ];
    }
}
