<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimientosRequest extends FormRequest
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

            "valor_movimiento"=>"required",
            "tipo_movimiento"=>"required",

            //relaciones
            "id_wallet"=>"required",
            "id_repartidor"=>"required"
        ];
    }
}
