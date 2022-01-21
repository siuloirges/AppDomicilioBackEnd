<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActualizarAliadoRequest extends FormRequest
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
    public function rules(){
    $id = $this->id;
        return [
//            'nombre'=>'required',
//            'razon_social'=>[
//                'required',
//                Rule::unique('aliados')->ignore($id),
//            ],
            'nit'=>[
                'required',
                'max:11',
                Rule::unique('aliados')->ignore($id)
            ]
        ];
    }
}
