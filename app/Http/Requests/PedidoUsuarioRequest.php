<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Nyholm\Psr7\Request;

class PedidoUsuarioRequest extends FormRequest
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
//            dd(Request()),

            //relaciones
            'id_usuario'=>'required|numeric',
            'id_pedido'=>'required|numeric',
        ];
    }
}
