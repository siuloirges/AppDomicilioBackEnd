<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\Http\Requests\ActualizarContactoRequest;
use App\Http\Requests\ContactoRequest;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $index = Contacto::paginate(20);
            return response()->json([
                'success'=>true,
                'data'=>$index, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception){
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción ContactoController@index'
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactoRequest $request)
    {
        try{
            $contacto = new Contacto;
            $contacto->nombre = $request->nombre;
            $contacto->cargo = $request->cargo;
            $contacto->telefono = $request->telefono;
            $contacto->email = $request->email;
            $contacto->id_aliado = $request->id_aliado;
            $contacto->save();
            return response()->json([
                'success'=>true,
                'data'=>$contacto, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de ContactoConroller@store'
            ],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show($contacto)
    {
        try{
            $show = $show = Contacto::find($contacto);
            return response()->json([
                'success'=>true,
                'data'=>$show, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de ContactoConroller@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarContactoRequest $request, Contacto $contacto)
    {
        try{
            $contacto->update($request->all());
            return response()->json([
                'success'=>true,
                'data'=>$contacto, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de ContactoConroller@update'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            // DB::table('aliados')->where("id",'=',$aliado->id)->delete();
            //$aliado->destroy();
            $contacto = Contacto::destroy($id);
            return response()->json([
                'success'=>true,
                'data'=>$contacto, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de ContactoConroller@destroy'
            ],404);
        }
    }
}
