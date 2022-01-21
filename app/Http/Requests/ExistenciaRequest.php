<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExistenciaRequest extends FormRequest
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

            'id_producto'=>'required|numeric',
            'id_categoria'=>'required|numeric',
            'id_sucursal'=>'required|numeric',
            'id_aliado'=>'required|numeric',
//            'existencia'=>'required|unique:existencia',
//            'existencia' => [
//                'required',
////                'digits_between:7,12',
////                Rule::unique('users')->ignore($id),
//            ],


        ];
    }
}
