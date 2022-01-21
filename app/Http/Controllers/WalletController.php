<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Movimientos;
use App\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//
        try{

            $id = request()->id_repartidor;
            $wattet  = Wallet::where('id_repartidor','=',$id)->first();
            $new=false;
            $movimientos=[];

            if($wattet==null){

                $wattet = new Wallet();
                $wattet->saldo_actual = null;
                $wattet->credito_actual = null;
                $wattet->id_repartidor = $id;
                $wattet->save();

                $wattet  = Wallet::where('id_repartidor','=',$id)->first();
                $new=true;
            }else{
                $movimientos=Movimientos::where('id_wallet',$wattet->id)->orderBy('created_at','desc')->get();
            }

            return response()->json(['success'=>true,'data'=>$wattet,'movimientos'=>$movimientos,'nuevo'=>$new,'message'=>'resolvio la petición'],200);

        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción WalletController@index'],500 );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalletRequest $request)
    {

        try{

            $wallet = new Wallet();
            $wallet->saldo_actual = $request->saldo_actual;
            $wallet->credito_actual = $request->credito_actual;
            $wallet->id_repartidor = $request->id_repartidor;
            $wallet->save();

            return response()->json(['success'=>true,'data'=>$request->all(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción WalletController@store'],500 );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        try{
//            return $id;
            $wallet =  Wallet::find($id);


            return response()->json(['success'=>true,'data'=>$wallet, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción WalletController@show'],500 );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(WalletRequest $request,  $id)
    {
        try{

            $wallet = Wallet::find($id);

           if($request->saldo_actual!=null){$wallet->saldo_actual = $request->saldo_actual;}
           if($request->credito_actual!=null){ $wallet->credito_actual = $request->credito_actual;}
           if($request->id_repartidor!=null){$wallet->id_repartidor = $request->id_repartidor;}

            $wallet->save();
            $walletSave = Wallet::find($id);

            return response()->json(['success'=>true,'data'=>$walletSave, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción WalletController@update'],500 );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $wallet = Wallet::find($id);
            $wallet->delete();
            $walletSave = Wallet::find($id);

            return response()->json(['success'=>true,'data'=>$walletSave, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción WalletController@destroy'],500 );
        }


    }
}
