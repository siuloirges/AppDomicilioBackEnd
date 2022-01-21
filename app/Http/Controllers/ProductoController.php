<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarProductoRequest;
use App\Http\Requests\ProductoRequest;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return    dd(\request()->user);
        try{

            if(request()->user!=null){

                $index = Producto::where('id_aliado',request()->user)->paginate(20);
                return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la peticion'],200);

            }else{
                $id_aliado = Auth::user()->id_aliado;
                $index = Producto::where('id_aliado',$id_aliado)->get();
                return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la peticion'],200);
            }


        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepcion ProductoController@index'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {

        try{

            $Producto = new Producto;
            $Producto->url_imagen_producto =$request->url_imagen_producto;
            $Producto->titulo = $request->titulo;
            $Producto->codigo = $request->codigo;
            $Producto->descripcion = $request->descripcion;
            $Producto->precio = $request->precio;
            $Producto->disponibilidad = $request->disponibilidad;
            $Producto->is_combo = $request->is_combo;
            $Producto->is_promo = $request->is_promo;
            $Producto->precio_promo = $request->precio_promo;

//            $Producto->descripcion_promo = $request->descripcion_promo;
//
            //relaciones
            $Producto->id_aliado = $request->id_aliado;
            $Producto->id_categoria_producto = $request->id_categoria_producto;

            $Producto->save();


            return response()->json(['success'=>true,'data'=>$request->all(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción ProductoController@store'],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        try{

            $show = $producto;
            return response()->json(['success'=>true,'data'=>$show, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción ProductoController@show'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarProductoRequest $request, Producto $producto)
    {
        try{
             $producto->update($request->all());
            return response()->json(['success'=>true,'data'=>$producto, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción ProductoController@update'],404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $user = Producto::destroy($id);

            return response()->json(['success'=>true,'data'=>$user, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción ProductoController@destroy'],404);
        }
    }
}
