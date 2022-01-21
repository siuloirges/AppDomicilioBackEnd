<?php

namespace App\Http\Controllers;

use App\CategoriaSucursales;
use App\Http\Requests\CategoriaSucursalesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaSucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return request()->id_sucursal;
        try{
            if(request()->user!=null){
//                dd(request()->id_sucursal);
                $index = CategoriaSucursales::where('id_sucursal', request()->id_sucursal )
                    ->where('id_aliado', request()->user )
                     ->where('id_sucursal',request()-> id_sucursal )
                    ->paginate(20);
            }else{
                $id_aliado = Auth::user()->id_aliado;
                $index = CategoriaSucursales::where('id_sucursal', request()->id_sucursal )
                    ->where('id_aliado', $id_aliado )
                    ->paginate(20);
            }

//            $index = CategoriaSucursales::paginate(20);

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
    public function store(CategoriaSucursalesRequest $request)
    {
        try{

            $user = new CategoriaSucursales;
            $user->nombre = $request->nombre;
            $user->id_sucursal = $request->id_sucursal;
            $user->id_aliado = $request->id_aliado;
            $user->save();


            return response()->json(['success'=>true,'data'=>$request->all(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción CategoriaSucursalesController@store'],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoriaSucursales  $categoriaSucursales
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $show = CategoriaSucursales::find($id);
            return response()->json([
                'success' => true,
                'data' => $show, 'message' => 'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de CategoriaSucursalesController@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoriaSucursales  $categoriaSucursales
     * @return \Illuminate\Http\Response
     */
    public function update( CategoriaSucursalesRequest $request,$id)
    {
        try{
//            dd($categoriaSucursales);
            $index = CategoriaSucursales::where('id',$id)->update($request->all());
//            CategoriaSucursales::find($id);
            return response()->json(['success'=>true,'data'=>$id, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción CategoriaSucursalesRequest@update'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoriaSucursales  $categoriaSucursales
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try{

            $user = CategoriaSucursales::destroy($id);

            return response()->json(['success'=>true,'data'=>$id, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoDocumentoController@destroy'],404);
        }
    }
}
