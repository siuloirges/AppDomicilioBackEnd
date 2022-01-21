<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\Base64ToFile;
use App\Http\Requests\tipoDireccionesRequest;
use App\tipoDirecciones;
use Illuminate\Http\Request;

class TipoDireccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $index =tipoDirecciones::paginate(20);

            return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoDireccionesController@index'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(tipoDireccionesRequest $request)
    {
        try{

           $var = Base64ToFile::getDistanceBetweenPointsNew($request->latitude1,$request->longitude1,$request->latitude2,$request->longitude2);

            return response()->json(['success'=>true,'data'=>$var, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoDireccionesController@store'],404);
        }



    }


    /**
     * Display the specified resource.
     *
     * @param  \App\tipoDirecciones  $tipoDirecciones
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        try {
            $show = tipoDirecciones::find($id);
            return response()->json([
                'success' => true,
                'data' => $show, 'message' => 'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de TipoDireccionesController@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipoDirecciones  $tipoDirecciones
     * @return \Illuminate\Http\Response
     */
    public function update(tipoDireccionesRequest $request, tipoDirecciones $tipoDirecciones)
    {
        try{
            $tipoDirecciones->update($request->all());
            return response()->json(['success'=>true,'data'=>$tipoDirecciones, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción UsuarioController@update'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipoDirecciones  $tipoDirecciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $user = tipoDirecciones::destroy($id);

            return response()->json(['success'=>true,'data'=>$id, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoDocumentoController@destroy'],404);
        }
    }
}
