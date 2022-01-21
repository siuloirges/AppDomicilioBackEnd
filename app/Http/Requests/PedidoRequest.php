<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
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
            'numero_pedido' => 'required',
            'estado'=>'required',
            'generada'=> 'nullable|numeric|min:0|max:1',
            'autorizada'=> 'nullable|numeric|min:0|max:1',
            'preparada'=> 'nullable|numeric|min:0|max:1',
            'en_transito'=> 'nullable|numeric|min:0|max:1',
            'entregada'=> 'nullable|numeric|min:0|max:1',
            'cancelada'=> 'nullable|numeric|min:0|max:1',
            'metodo_de_pago'=>'required',
            'precio_total'=>'required',


            'aliado_id'=>'required|numeric',
            'direccion_id'=>'required|numeric',
            'sucursal_id'=>'required|numeric',

//            'repartidor_id'=>'required|numeric',
            'cliente_id'=>'required|numeric ',
        ];
    }
}
