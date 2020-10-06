<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstudianteFotoRequest extends FormRequest
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
     * Validate that an uploaded file maximo 1024 kilobytes..
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|image|max:1024',
        ];
    }
}
