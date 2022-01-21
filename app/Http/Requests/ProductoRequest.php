<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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

            'titulo'=>'required|unique:productos',
//            'codigo'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
            'disponibilidad'=>'required|bool',
//            'existencia'=>'required|numeric',
            'id_aliado'=>'required',
            'id_categoria_producto'=>'required',
        ];
    }
}
