<?php

namespace App\Http\Requests;

use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class SucursaleRequest extends FormRequest
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

            'nombre'    => 'required',
            'direccion' => 'required',

//            'id_aliado' => 'required|numeric',
            'telefono'  => 'numeric|digits_between:7,12',
            'url_foto_perfil' => 'required',
            'url_foto_portada' => 'required',

        ];

    }

}
