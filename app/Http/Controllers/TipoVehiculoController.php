<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoVehiculoRequest;
use App\TipoVehiculo;
use Illuminate\Http\Request;

class TipoVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $index =TipoVehiculo::get();

            return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la peticion'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepcion TipoVehiculoController@index'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoVehiculoRequest $request)
    {
        try{

            $tipoVehiculo = new TipoVehiculo;
            $tipoVehiculo->nombre = $request->nombre;
            $tipoVehiculo->save();

            return response()->json(['success'=>true,'data'=>$request->all(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoVehiculoController@store'],404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoVehiculo  $tipoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show($tipoVehiculo)
    {

        try {
            $show = TipoVehiculo::find($tipoVehiculo);
            return response()->json([
                'success' => true,
                'data' => $show, 'message' => 'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de TipoVehiculoController@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoVehiculo  $tipoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(TipoVehiculoRequest $request, TipoVehiculo $tipoVehiculo)
    {
//        dd($request);
        try{
            $tipoVehiculo->update($request->all());
            return response()->json([
                'success'=>true,
                'data'=>$tipoVehiculo, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de TipoDocumentoController@update'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoVehiculo  $tipoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $user = TipoVehiculo::destroy($id);

            return response()->json(['success'=>true,'data'=>$id, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoDocumentoController@destroy'],404);
        }
    }
}
