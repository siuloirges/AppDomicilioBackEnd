<?php

namespace App\Http\Controllers;

use App\DetallePedido;
use App\Http\Requests\DetallePedidoRequest;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
//
            $index = DetallePedido::where('id_pedido',request()->id_pedido)
                ->with('producto')
                ->get();
//
            return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción DetallePedidoController@index'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetallePedidoRequest $request)
    {
        try{

            $user = new DetallePedido();
            $user->cantidad     = $request->cantidad;
            $user->id_pedido  = $request->id_pedido;
            $user->id_producto   = $request->  id_producto;
            $user->save();

            return response()->json(['success'=>true,'data'=>$request->all(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción DetallePedidoController@store'],404);
        }
//
//        'catidad',
//        'id_pedido',
//        'id_producto'//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetallePedido  $detallePedido
     * @return \Illuminate\Http\Response
     */
    public function show($detallePedido)
    {
        try {
            $show = DetallePedido::find($detallePedido);
            return response()->json([
                'success' => true,
                'data' => $show, 'message' => 'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de DetallePedidoController@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetallePedido  $detallePedido
     * @return \Illuminate\Http\Response
     */
    public function update(DetallePedidoRequest $request, $detallePedido)
    {
        try{
//            dd($usuario);
            $index = DetallePedido::where('id',$detallePedido)->update($request->all());
//           $index =  $usuario->update($request->all());
            return response()->json(['success'=>true,'data'=>$detallePedido, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción DetallePedidoController@update'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetallePedido  $detallePedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
//            $model = new DetallePedido();
           DetallePedido::destroy($id);
            return response()->json(['success'=>true,'data'=>$id, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción DetallePedidoController@destroy'],404);
        }
    }
}
