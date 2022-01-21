<?php

namespace App\Http\Controllers;

use App\CategoriaSucursales;
use App\ExistenciaModel;
use App\Http\Repositorios\Base64ToFile;
use App\Sucursale;
use App\Http\Requests\ActualizarSucursaleRequest;
use App\Http\Requests\SucursaleRequest;
use App\Sucursales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;


class SucursaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            if(\request()->id_asistente!=null){
                $show = Sucursales::where('id_asistente','=',\request()->id_asistente)->first();
                return response()->json([
                    'success' => true,
                    'data' => $show, 'message' => 'resolvio la peticion'
                ], 200);
            }
            if(\request()->id_sucursal_copia!=null){

                $id_sucursal_copia=Sucursales::where('id',\request()->id_sucursal_copia)->first();

                if($id_sucursal_copia) {

                    $unique = ' COPIA: ' . uniqid();
                    $sucursale = new Sucursales;
                    $sucursale->nombre = $id_sucursal_copia->nombre . $unique;
                    $sucursale->latitude = $id_sucursal_copia->latitude;
                    $sucursale->longitude = $id_sucursal_copia->longitude;
                    $sucursale->telefono = $id_sucursal_copia->telefono;
                    $sucursale->id_aliado = Auth::user()->id_aliado;
                    $sucursale->direccion = $id_sucursal_copia->direccion;
                    $sucursale->estado = 'no_disponible';
                    $sucursale->url_foto_perfil = Base64ToFile::storage($id_sucursal_copia->url_foto_perfil, 'sucursales/tel-' . $id_sucursal_copia->telefono);
                    $sucursale->url_foto_portada = Base64ToFile::storage($id_sucursal_copia->url_foto_portada, 'sucursales/tel-' . $id_sucursal_copia->telefono);
                    $sucursale->save();

                    $categorias=CategoriaSucursales::where('id_sucursal',$id_sucursal_copia->id)->get();

                     if($categorias!='[]'){

                         foreach ($categorias as $i){

                             $categoria = new CategoriaSucursales;
                             $categoria->nombre = $i->nombre;
                             $categoria->id_sucursal = $sucursale->id;
                             $categoria->id_aliado = $i->id_aliado;
                             $categoria->save();

                            $existencias = ExistenciaModel::where('id_categoria',$i->id)->get();

                             if($existencias!='[]'){

                                 foreach ($existencias as $item){

                                     $existencia = new ExistenciaModel;
                                     $existencia->id_producto = $item->id_producto;
                                     $existencia->id_categoria = $categoria->id;
                                     $existencia->id_sucursal =$sucursale->id;
                                     $existencia->id_aliado = $item->id_aliado;
                                     $existencia->existencia = $item->existencia;
                                     $existencia->nombre = $item->nombre;
                                     $existencia->save();

                                 }

                             }

                         }

                     }
                    $id_aliado = Auth::user()->id_aliado;
                    $index = Sucursales::where('id_aliado',$id_aliado)->paginate(20);
                    return response()->json([
                        'success'=>true,
                        'data'=>$index
                    ], 200);
                }
            }else{

                if(request()->user==1){

//             return dd(request());
                    $index = Sucursales::where('id_aliado',request()->id_aliado)->paginate(20);

//            $index =Sucursale::paginate(20);
                    return response()->json([
                        'success'=>true,
                        'data'=>$index, 'message'=>'resolvio la peticion'
                    ], 200);
//
                }else{
                    $id_aliado = Auth::user()->id_aliado;
                    $index = Sucursales::where('id_aliado',$id_aliado)->paginate(20);

//                $index =Sucursale::paginate(20);
                    return response()->json([
                        'success'=>true,
                        'data'=>$index, 'message'=>'resolvio la peticion'
                    ], 200);
                }
            }



        }catch (\Exception $exception){

            return  response()->json([
                'data'=>$exception->getMessage(),
                'success'=>false,
                'message'=>'Fallo de excepción SucursaleController@index'
            ],404);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SucursaleRequest $request)
    {
//        return   $request;
        try{


            $sucursale = new Sucursales;
            $sucursale->nombre = $request->nombre;
            $sucursale->latitude = $request->latitude;
            $sucursale->longitude = $request->longitude;
            $sucursale->telefono = $request->telefono;
            $sucursale->id_aliado = Auth::user()->id_aliado;
            $sucursale->direccion = $request->direccion;
            $sucursale->estado = $request->estado;
            $sucursale->url_foto_perfil =  Base64ToFile::storage($request->url_foto_perfil, 'sucursales/tel-'.$request->telefono);
            $sucursale->url_foto_portada = Base64ToFile::storage($request->url_foto_portada, 'sucursales/tel-'.$request->telefono);
            $saveSucursal =  $sucursale->save();
//            $saveSucursal= ;

            return response()->json([
                'success'=>true,
                'data'=>$sucursale, 'message'=>'resolvio la petición'
            ], 200);
        }catch(\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de SucursaleConroller@store'
            ],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursale  $sucursale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $show = Sucursales::find($id)->first();
            return response()->json([
                'success' => true,
                'data' => $show, 'message' => 'resolvio la peticion'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepcion de SucursaleConroller@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursale  $sucursale
     * @return \Illuminate\Http\Response
     */
    public function update( SucursaleRequest $request, $id )
    {
        try{

//            $index = Sucursales::where('id',$sucursal)->update($request->all());

            $sucursale = Sucursales::find($id);
            if($request->nombre!=null){ $sucursale->nombre = $request->nombre;}
            if($request->latitude!=null){$sucursale->latitude = $request->latitude;}
            if($request->longitude!=null){$sucursale->longitude = $request->longitude;}
            if($request->telefono!=null){$sucursale->telefono = $request->telefono;}
            if($request->id_aliado!=null){$sucursale->id_aliado = $request->id_aliado;}
            if($request->direccion!=null){$sucursale->direccion = $request->direccion;}
            if($request->estado!=null){$sucursale->estado = $request->estado;}
            if($request->url_foto_perfil!='no'){$sucursale->url_foto_perfil =  Base64ToFile::storage($request->url_foto_perfil, 'sucursales/tel-'.$request->telefono);}
            if($request->url_foto_portada!='no'){$sucursale->url_foto_portada = Base64ToFile::storage($request->url_foto_portada, 'sucursales/tel-'.$request->telefono);}
             $sucursale->save();

            return response()->json([
                'success'=>true,
                'data'=>$sucursale,
                'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de AliadoConroller@update'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursale  $sucursale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            // DB::table('aliados')->where("id",'=',$aliado->id)->delete();
            //$aliado->destroy();
            $sucursale = Sucursales::destroy($id);

            $id_aliado = Auth::user()->id_aliado;
            $index = Sucursales::where('id_aliado',$id_aliado)->paginate(20);
            return response()->json([
                'success'=>true,
                'data'=>$index, 'message'=>'resolvio la petición'
            ], 200);

        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de SucursaleConroller@destroy'
            ],404);
        }
    }
}
