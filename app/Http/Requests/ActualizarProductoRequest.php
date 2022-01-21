<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Nyholm\Psr7\Request;

class ActualizarProductoRequest extends FormRequest
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

//        $id = $this->Producto->id;
        return [

            'descripcion'=>'required',
            'precio'=>'required',
            'disponibilidad'=>'required|bool',

            'is_combo'=>'required|bool',
            'is_promo'=>'required|bool',
            'precio_promo'=>'numeric',
            'descripcion_promo'=>'',
            'id_aliado'=>'required',
            'id_categoria_producto'=>'required',
        ];
    }
}
