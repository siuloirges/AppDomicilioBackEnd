<?php

namespace App\Http\Controllers;

use App\Aliado;
use App\DetallePedido;
use App\Http\Repositorios\FCM;
use App\Http\Requests\ActualizarPedidoRequest;
use App\Http\Requests\PedidoRequest;
use App\Pedido;
use App\Sucursales;
use App\Usuario;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;
use function Sodium\add;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            if (request()->administrador_all==1) {



                    $pedidos = Pedido::get();

                    $generadas=0;
                    $autorizadas=0;
                    $preparadas=0;
                    $entregadas=0;
                    $canceladas=0;



                    foreach ($pedidos as $i) {

                        if($i->estado=='generada'){
                            $generadas=$generadas+1;
                        }

                        if($i->estado=='autorizada'){
                            $autorizadas=$autorizadas+1;
                        }

                        if($i->estado=='preparada'){
                            $preparadas=$preparadas+1;
                        }

                        if($i->estado=='entregada'){
                            $entregadas=$entregadas+1;
                        }

                        if($i->estado=='cancelada'){
                            $canceladas=$canceladas+1;
                        }
                    }


                    return response()->json(['success' => true,'generadas'=>$generadas,'autorizada'=>$autorizadas,'preparada'=>$preparadas, 'entregada'=>$entregadas,'cancelada'=>$canceladas,'message' => 'resolvio la petición'], 200);
            }

            if (request()->cliente_id) {
                $index = Pedido::where('cliente_id', request()->cliente_id)
                    ->where('estado','=',request()->estado)
//                    ->join('aliados', 'aliados.id', '=', 'pedidos.aliado_id')
//                    ->join('sucursales', 'sucursales.id', '=', 'pedidos.sucursal_id')
//                    ->select('pedidos.*', 'aliados.nombre as aliado', 'aliados.url_foto_perfil as foto_aliado', 'sucursales.nombre as sucursal', 'sucursales.direccion as direccion_sucursal', 'sucursales.direccion as direccion_sucursal')

                    ->with('direccion')
                    ->with('sucursal')
                    ->with('cliente')
                    ->orderBy('created_at','desc')
                    ->paginate(20);


            }

            if (request()->aliado_id) {
                //                return request()->id_aliado ;

                if (request()->all!=null) {

                    $pedidos = Pedido::where('aliado_id', request()->aliado_id)->get();
                    $aliado = Aliado::where('id', request()->aliado_id)->first();
                    $generadas=0;
                    $autorizadas=0;
                    $preparadas=0;
                    $entregadas=0;
                    $canceladas=0;



                    foreach ($pedidos as $i) {

                        if($i->estado=='generada'){
                            $generadas=$generadas+1;
                        }

                        if($i->estado=='autorizada'){
                            $autorizadas=$autorizadas+1;
                        }

                        if($i->estado=='preparada'){
                            $preparadas=$preparadas+1;
                        }

                        if($i->estado=='entregada'){
                            $entregadas=$entregadas+1;
                        }

                        if($i->estado=='cancelada'){
                            $canceladas=$canceladas+1;
                        }
                    }


                    return response()->json(['success' => true,"nombre"=>$aliado->nombre,"url_foto_perfil"=>$aliado->url_foto_perfil, 'generadas'=>$generadas,'autorizada'=>$autorizadas,'preparada'=>$preparadas, 'entregada'=>$entregadas,'cancelada'=>$canceladas,'message' => 'resolvio la petición'], 200);

                }else{
                    $index = Pedido::where('aliado_id', request()->aliado_id)
                     ->where('estado','=',request()->estado)
                     ->with('direccion')
                     ->with('sucursal')
                     ->with('cliente')
                     ->paginate(20);

                    return response()->json(['success' => true, 'data' => $index, 'message' => 'resolvio la peticion'], 200);
                }


            }

            if (request()->repartidor_id) {

                if (request()->all=='1') {
              
                    $pedidos = Pedido::where('repartidor_id', request()->repartidor_id)->get();
                    $user = Usuario::select('calificacion')->where('id', request()->repartidor_id)->first();
                
                    $nuevas=0;
                    $en_transito=0;
                    $entregadas=0;



                    foreach ($pedidos as $i) {

                        if($i->estado=='autorizada'||$i->estado=='preparada'){
                            $nuevas=$nuevas+1;
                        }

                        if($i->estado=='en_transito'){
                            $en_transito=$en_transito+1;
                        }

                        if($i->estado=='entregada'){
                            $entregadas=$entregadas+1;
                        }


                    }


                    return response()->json(['success' => true,"calificacion"=>$user->calificacion,"autorizada"=>$nuevas,"en_transito"=>$en_transito, 'entregada'=>$entregadas,'data'=>'ok','message' => 'resolvio la peticion'], 200);
                }else{
                    $index  = Pedido::where('repartidor_id', request()->repartidor_id)
                        ->where('estado','=',request()->estado)
                        ->with('direccion')
                        ->with('sucursal')
                        ->with('cliente')
                        ->orderBy('created_at','desc')
                        ->paginate(20);
//
//                 $index = Pedido::where('repartidor_id', request()->repartidor_id)
//                    ->with('direccion')
//                    ->with('sucursal')
//                    ->with('cliente')
//                    ->paginate(20);
                }
               }

            if (request()->sucursal_id) {
                if (request()->all!=null) {
                    $pedidos = Pedido::where('sucursal_id', request()->sucursal_id)->get();
                    $sucursal = Sucursales::where('id', request()->sucursal_id)->first();
                    $generadas=0;
                    $autorizadas=0;
                    $preparadas=0;
                    $entregadas=0;
                    $canceladas=0;



                    foreach ($pedidos as $i) {

                        if($i->estado=='generada'){
                            $generadas=$generadas+1;
                        }

                        if($i->estado=='autorizada'){
                            $autorizadas=$autorizadas+1;
                        }

                        if($i->estado=='preparada'){
                            $preparadas=$preparadas+1;
                        }

                        if($i->estado=='entregada'){
                            $entregadas=$entregadas+1;
                        }

                        if($i->estado=='cancelada'){
                            $canceladas=$canceladas+1;
                        }
                    }


                    return response()->json(['success' => true,"data"=>'ok',"nombre"=>$sucursal->nombre,"estado"=>$sucursal->estado,"url_foto_perfil"=>$sucursal->url_foto_perfil, 'generadas'=>$generadas,'autorizada'=>$autorizadas,'preparada'=>$preparadas, 'entregada'=>$entregadas,'cancelada'=>$canceladas,'message' => 'resolvio la petición'], 200);
                }else{
                    $index  = Pedido::where('sucursal_id', request()->sucursal_id)
                                   ->where('estado','=',request()->estado)
                                   ->with('direccion')
                                   ->with('sucursal')
                                   ->with('cliente')
                                   ->orderBy('created_at','desc')
                                   ->paginate(20);



//                    return response()->json(['success' => true, 'data' => 'ok','generadas'=>$pedidosGeneradosAsistente, 'message' => 'resolvio la petición'], 200);
                }

            }

            return response()->json(['success' => true, 'data' => $index, 'message' => 'resolvio la peticion'], 200);
        } catch (\Exception $exception) {
            return  response()->json(['data' => $exception->getMessage(), 'success' => false, 'message' => 'Fallo de excepción PedidoController@index'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedidoRequest $request)
    {
        try {
//
            $pedido = new Pedido;
            $pedido->estado   = $request->estado;
            $pedido->generada   = $request->generada === '1' ? now() : null;
            $pedido->autorizada = $request->autorizada === '1' ? now() : null;
            $pedido->preparada  = $request->preparada === '1' ? now() : null;
            $pedido->en_transito  = $request->en_transito === '1' ? now() : null;
            $pedido->entregada  = $request->entregada === '1' ? now() : null;
            $pedido->cancelada  = $request->cancelada === '1' ? now() : null;
            $pedido->numero_pedido = $request->numero_pedido . uniqid();
            $pedido->metodo_de_pago = $request->metodo_de_pago;
            $pedido->precio_total = $request->precio_total;
            $pedido->motivo_anulacion = $request->motivo_anulacion;
            $pedido->aliado_id  = $request->aliado_id;
            $pedido->sucursal_id  = $request->sucursal_id;
            $pedido->direccion_id  = $request->direccion_id;
            $pedido->repartidor_id = $request->repartidor_id;
            $pedido->cliente_id = $request->cliente_id;
            $pedido->save();
//
            $pedidoProductos =  json_decode($request->pedido, true);

            foreach ($pedidoProductos as $inDetallePedido) {

                $detallePedido = new DetallePedido;
                $detallePedido->cantidad = $inDetallePedido['cantidad'];
                $detallePedido->id_producto = $inDetallePedido['id_producto'];
                $detallePedido->id_pedido  = $pedido->id;
                $detallePedido->save();
            }


            $data = Pedido::where('id',$pedido->id)
            ->with('direccion')
            ->with('sucursal')
            ->with('cliente')
            ->first();

            $asistente_token=Usuario::select('fcm_token')->where('id_sucursal','=',$request->sucursal_id)->first();

            if($asistente_token!=null){
             FCM::sendNotification($asistente_token->fcm_token,'Nuevo pedido','Mira en tus nuevas ordenes',$data);
            }

            return response()->json(['success' => true, "data"=>$pedido,'message' => 'resolvio la petición'], 200);
        } catch (\Exception $exception) {
            return  response()->json(['data' => $exception->getMessage(), 'success' => false, 'message' => 'Fallo de excepción PedidoController@store'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        try {

            $show = $pedido;
            return response()->json(['success' => true, 'data' => $show, 'message' => 'resolvio la petición'], 200);
        } catch (\Exception $exception) {
            return  response()->json(['data' => $exception, 'success' => false, 'message' => 'Fallo de excepción PedidoController@show'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarPedidoRequest $request, $pedido)
    {
    
        try {

            $pedido =Pedido::where('id','=',$pedido)->first();

            $fullDataPedido = Pedido::where('id',$pedido->id)
                ->with('direccion')
                ->with('sucursal')
                ->with('cliente')
                ->first();

            if($request->repartidor_id!=null){

                if ($pedido->repartidor_id==null){

                    $pedido->repartidor_id   = $request->repartidor_id;
                    $pedido->update();
                    $asistente_token=Usuario::select('fcm_token')->where('id_sucursal','=',$pedido->sucursal_id)->first();
                    if($asistente_token!=null){
                    FCM::sendNotification($asistente_token->fcm_token,'Un repartidor tomo uno de tus pedidos','Abrir',$fullDataPedido);
                    }
                 return response()->json(['success' => true, 'data' => 'Enhorabuena, usted esta acargo de este pedido', 'result' => '1','message' => 'resolvio la petición'], 200);
                }else{
                    return response()->json(['success' => true, 'data' => 'lo sentimos, algien ya a tomado este pedido primero', 'result' => '0','message' => 'resolvio la petición'], 200);
                }


            }

            if($request->buscar!=null){

                $repartidores=Usuario::select('fcm_token')->where('rol','=','repartidor')->where('fcm_token','!=',null)->get();
                foreach ($repartidores as $i) {

                    FCM::sendNotification($i->fcm_token,'¡Aprovecha!, Nuevo domicilio','tap para definir',$fullDataPedido,'repartidor');
                }
                return response()->json(['success' => true, 'data' => 'ok', 'message' => 'resolvio la petición'], 200);

            }




                $pedido->estado   = $request->estado;
                if($request->motivo_anulacion!=null){$pedido->motivo_anulacion = $request->roll.": ".$request->motivo_anulacion;}
                $pedido->generada = $pedido->     generada ?: ($request->generada === '1' ? now() : null);
                $pedido->autorizada = $pedido->   autorizada ?: ($request->autorizada === '1' ? now() : null);
                $pedido->preparada = $pedido->    preparada ?: ($request->preparada === '1' ? now() : null);
                $pedido->en_transito = $pedido->    en_transito ?: ($request->en_transito === '1' ? now() : null);
                // $pedido->en_transito  = $pedido->en_transito === '1' ? now() : null;
                $pedido->entregada = $pedido->    entregada ?: ($request->entregada === '1' ? now() : null);
                $pedido->cancelada = $pedido->    cancelada ?: ($request->cancelada === '1' ? now() : null);
                $pedido->save();

                $fullDataPedido = Pedido::where('id',$pedido->id)
                ->with('direccion')
                ->with('sucursal')
                ->with('cliente')
                ->first();


            if($request->roll=='cliente'){

                    $asistente_token=Usuario::select('fcm_token')->where('id_sucursal','=',$pedido->sucursal_id)->first();

                    if($asistente_token!=null){
                        FCM::sendNotification($asistente_token->fcm_token,'cambio de estado a: '.$pedido->estado,'Tap aqui',$fullDataPedido);
                    }

                    $reoartidor_token=Usuario::select('fcm_token')->where('id','=',$pedido->repartidor_id)->first();

                    if($reoartidor_token!=null){
                        FCM::sendNotification($reoartidor_token->fcm_token,'Tu encargo a cambio de estado a: '.$pedido->estado,'Tap aqui',$fullDataPedido);
                    }
                }

                if($request->roll=='asistente'||$request->roll=='aliado'){


                    $cliente_token=Usuario::select('fcm_token')->where('id','=',$pedido->cliente_id)->first();

                    if($cliente_token!=null){
                        FCM::sendNotification($cliente_token->fcm_token,'Novedades con tu pedido',' Estado: '.$pedido->estado,$fullDataPedido);
                    }



                    $reoartidor_token=Usuario::select('fcm_token')->where('id','=',$pedido->repartidor_id)->first();

                    if($reoartidor_token!=null){
                        FCM::sendNotification($reoartidor_token->fcm_token,'Tu encargo a cambio de estado a: '.$pedido->estado,'Tap aqui',$fullDataPedido);
                    }
                }

                if($request->roll=='repartidor'){


//                    return $fullDataPedido;
                    $asistente_token=Usuario::select('fcm_token')->where('id_sucursal','=',$pedido->sucursal_id)->first();

                    if($asistente_token!=null){
                        FCM::sendNotification($asistente_token->fcm_token,'cambio de estado a: '.$pedido->estado,'Tap aqui',$fullDataPedido);
                    }

                    $cliente_token=Usuario::select('fcm_token')->where('id','=',$pedido->cliente_id)->first();

                    if($cliente_token!=null){

                        if($pedido->estado=='entregada'){
                            FCM::sendNotification($cliente_token->fcm_token,'Novedades con tu pedido',' Estado: '.$pedido->estado,$fullDataPedido,'evaluar');
                        }else{
                            FCM::sendNotification($cliente_token->fcm_token,'Novedades con tu pedido',' Estado: '.$pedido->estado,$fullDataPedido);
                        }
                       
                    }
//                    return $asistente_token;
                }
            // $index = Pedido::where('id',$pedido)->update($request->all());

//            $pedido->numero_pedido = $request->numero_pedido;
//            $pedido->metodo_de_pago = $request->metodo_de_pago;
//            $pedido->precio_total = $request->precio_total;
//            $pedido->motivo_anulacion = $request->motivo_anulacion;
//
//            $pedido->aliado_id  = $request->aliado_id;
//
//            $pedido->sucursal_id  = $request->sucursal_id;
//            $pedido->direccion_id  = $request->direccion_id;
//            $pedido->repartidor_id = $request->repartidor_id;
//            $pedido->cliente_id = $request->cliente_id;



            return response()->json(['success' => true, 'data' => $pedido, 'message' => 'resolvio la petición'], 200);
        } catch (\Exception $exception) {
            return  response()->json(['data' => [], 'success' => false, 'message' => 'Fallo de excepción PedidoController@update', "error" => $exception->getMessage()], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $user = Pedido::destroy($id);
            return response()->json(['success' => true, 'data' => $user, 'message' => 'resolvio la petición'], 200);
        } catch (\Exception $exception) {
            return  response()->json(['data' => $exception, 'success' => false, 'message' => 'Fallo de excepción de PedidoController@destroy'], 404);
        }
    }
}
