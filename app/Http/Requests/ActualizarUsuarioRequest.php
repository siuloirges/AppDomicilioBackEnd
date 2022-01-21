<?php

namespace App\Http\Requests;


use App\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Laravel\Passport\Bridge\User;

class ActualizarUsuarioRequest extends FormRequest
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
        $id = Auth::user()->id;
//        dd($id);
        return [
            'nombre' => 'max:100',
            'tipo_documento_id' => 'numeric',
            'numero_documento' => [
//                'required',
                'numeric',
                'digits_between:7,12',
                Rule::unique('users')->ignore($id),
            ],
//            'url_foto_perfil'=>'',
            'telefono' => 'numeric|digits_between:7,12',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],

            'contrasena' => 'digits_between:8,100',
        ];
    }
}
