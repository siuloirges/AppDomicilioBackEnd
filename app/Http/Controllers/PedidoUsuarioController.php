<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\FCM;
use App\Http\Requests\PedidoUsuarioRequest;
use App\PedidoUsuario;
use Illuminate\Http\Request;

class PedidoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $index = PedidoUsuario::paginate(20);

            return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción PedidoController@index'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedidoUsuarioRequest $request)
    {
        try{

            $i = new PedidoUsuario;
            $i->id_usuario = $request->id_usuario;
            $i->id_pedido  =  $request->id_pedido;
            $i->save();

            return response()->json(['success'=>true,'data'=>$request->all(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción PedidoUsuarioController@store'],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PedidoUsuario  $pedidoUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoUsuario $pedidoUsuario)
    {
        try{

            $show = $pedidoUsuario;
            return response()->json(['success'=>true,'data'=>$show, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción PedidoController@show'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PedidoUsuario  $pedidoUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(PedidoUsuarioRequest $request, PedidoUsuario $pedidoUsuario)
    {
        // FCM::sendNotification();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PedidoUsuario  $pedidoUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoUsuario $pedidoUsuario)
    {

    }
}
