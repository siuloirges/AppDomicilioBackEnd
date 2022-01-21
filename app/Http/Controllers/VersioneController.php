<?php

namespace App\Http\Controllers;

use App\Versione;
use Illuminate\Http\Request;

class VersioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $versiones =Versione::orderBy('created_at','desc')->get();
            return response()->json(['success'=>true,'data'=>$versiones[0]??"", 'message'=>'resolvio la peticion'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepcion VersioneController@index'],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{
            //
         $versiones = new Versione();
            
         $versiones->version = $request->version;
         
            
         $versiones->save();
            
         return response()->json(['success'=>true,'data'=>$versiones, 'message'=>'resolvio la petición'],200);
     }catch (\Exception $exception){
         return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción VersioneController@store'],500 );
     }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Versione  $versione
     * @return \Illuminate\Http\Response
     */
    public function show(Versione $versione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Versione  $versione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Versione $versione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Versione  $versione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Versione $versione)
    {
        //
    }
}
