<?php

namespace App\Http\Controllers;

use App\ExistenciaModel;
use App\Http\Requests\ExistenciaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
//            return request();
            $id_aliado = Auth::user()->id_aliado;

            $index = ExistenciaModel::with('producto')->where('id_categoria', request()->id_categoria )->paginate(20);

            return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción ExistenciaController@index'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExistenciaRequest $request)
    {
        try{
            $user = new ExistenciaModel;
            $user->id_producto = $request->id_producto;
            $user->id_categoria = $request->id_categoria;
            $user->id_sucursal = $request->id_sucursal;
            $user->id_aliado = $request->id_aliado;
            $user->existencia = $request->existencia;
            $user->nombre = $request->nombre;
            $user->save();


            return response()->json(['success'=>true,'data'=>$request->all(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción ExistenciaController@store'],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{

            $show = ExistenciaModel::find($id);
            return response()->json(['success'=>true,'data'=>$show, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción TipoDocumentoController@show'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $index = ExistenciaModel::where('id',$id)->update($request->all());
            return response()->json(['success'=>true,'data'=>$id, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción ProductoController@update'],404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $user = ExistenciaModel::destroy($id);

            return response()->json(['success'=>true,'data'=>$user, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción ExistenciaController@destroy'],404);
        }
    }
}
