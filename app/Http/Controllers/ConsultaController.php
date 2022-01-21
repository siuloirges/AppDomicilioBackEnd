<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Sucursales;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filtro =  request()->filtro;
        $rol =  request()->rol;
        $dato =  request()->dato;
     
        
        if($rol=="cliente"){
            
          try {
            $sucursales = Sucursales::where($filtro,"LIKE","%$dato%")->where("estado","!=","no_disponible")->paginate(20);

          
            return response()->json(['success' => true, 'data' =>$sucursales, 'message' => 'resolvio la petición'], 200);
          } catch (\Exception $exception) {
              return  response()->json(['data' => $exception->getMessage(), 'success' => false, 'message' => 'Fallo de excepción ConsultaController@index'], 404);
          }

        }
        if($rol=="administrador"){
            
          try {

            // $NOW = now();
            // return $NOW;
            $sucursales = Sucursales::where($filtro,"LIKE","%$dato%")->paginate(20);
      
          
            return response()->json(['success' => true, 'data' => $sucursales, 'message' => 'resolvio la petición'], 200);
          } catch (\Exception $exception) {
              return  response()->json(['data' => $exception->getMessage(), 'success' => false, 'message' => 'Fallo de excepción ConsultaController@index'], 404);
          }

        }

        
    //    return "pepe";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

     
        $rol =  request()->rol;
        $fecha =  request()->fecha;

        if($rol=="administrador"){
            
            try {
  
            
             $sucursales = Pedido::where("created_at","like","%$fecha%")->paginate(20);
        
            
              return response()->json(['success' => true, 'data' => $sucursales, 'message' => 'resolvio la petición'], 200);
            } catch (\Exception $exception) {
                return  response()->json(['data' => $exception->getMessage(), 'success' => false, 'message' => 'Fallo de excepción ConsultaController@index'], 404);
            }
  
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
