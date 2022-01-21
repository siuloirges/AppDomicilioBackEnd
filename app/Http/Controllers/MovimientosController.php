<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\FCM;
use App\Http\Requests\MovimientosRequest;
use App\Movimientos;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        date_default_timezone_set('');
        $minute =  date('i');
        $hora   =  date('h');
        $day    =  date('d');
        $mes    =  date('m');
        $ano    =  date('Y');
        $fecha  = $ano."-".$mes."-".$day."T".$hora.":".$minute;

        $movimientos=Movimientos::where('id_wallet',\request()->id_wallet)->get();

        return $movimientos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovimientosRequest $request)
    {
        try{
//
            $movimiento = new Movimientos();

            $movimiento->valor_movimiento = $request->valor_movimiento;
            $movimiento->tipo_movimiento = $request->tipo_movimiento;
            $movimiento->id_wallet = $request->id_wallet;
            $movimiento->id_repartidor = $request->id_repartidor;

            $movimiento->save();

            return response()->json(['success'=>true,'data'=>$movimiento, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción WalletController@store'],500 );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movimientos  $movimientos
     * @return \Illuminate\Http\Response
     */
    public function show(Movimientos $movimientos)
    {
        //CREO QUE NO ES NECESARIO
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimientos  $movimientos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimientos $movimientos)
    {
        //CREO QUE NO SE PUEDE ACTUALIZAR UN MOVIMIENTO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movimientos  $movimientos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimientos $movimientos)
    {
        //CREO QUE NO SE PUEDE ELIMINAR UN MOVIMIENTO
    }
}
