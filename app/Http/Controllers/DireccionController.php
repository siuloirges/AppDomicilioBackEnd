<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\Http\Requests\DireccionesRecuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $id = Auth::user()->id;
            $index = Direccion::where('usuario_id',$id)->paginate(20);
//            $index = Direccion::paginate(20);

            return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción DireccionController@index'],404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DireccionesRecuest $request)
    {
        try{

            $user = new Direccion;
            $user->nombre     = $request->nombre;
            $user->direccion  = $request->direccion;
            $user->latitude   = $request->  latitude;
            $user->longitude  = $request->longitude;
            $user->referencia = $request->referencia;


            $user->usuario_id = $request->usuario_id;
            $user->tipo_direcion_id = $request->tipo_direcion_id;

            $user->save();

            return response()->json(['success'=>true,'data'=>$request->all(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción DireccionController@store'],404);
        }

//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function show($direccion)
    {



        try{

            $show = Direccion::find($direccion);
            return response()->json(['success'=>true,'data'=>$show, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoDocumentoController@show'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function update(DireccionesRecuest $request,  $direccion)
    {
        try{
//            dd($usuario);
            $index = Direccion::where('id',$direccion)->update($request->all());
//           $index =  $usuario->update($request->all());
            return response()->json(['success'=>true,'data'=>$direccion, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción DireccionController@update'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try{

            $user = Direccion::destroy($id);

            return response()->json(['success'=>true,'data'=>$id, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoDocumentoController@destroy'],404);
        }
    }
}
