<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActualizarContactoRequest extends FormRequest
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
        $id = $this->contacto->id;
        return [
            'nombre'=>'required',
            'cargo'=>'required',
            'telefono'=>[
                'required',
                Rule::unique('contactos')->ignore($id),
            ],
            'email'=>[
                'required',
                Rule::unique('contactos')->ignore($id),
            ]
        ];
    }
}
