<?php

namespace App\Http\Controllers;

use App\Aliado;
use App\Http\Repositorios\Base64ToFile;
use App\Http\Requests\ActualizarAliadoRequest;
use App\Http\Requests\AliadoRequest;

class AliadoController extends Controller
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
            $index =Aliado::paginate(20);
            return response()->json([
                'success'=>true,
                'data'=>$index, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception){
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción AliadoController@index'
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AliadoRequest $request)
    {
        try{

            $aliado = new Aliado;
            $aliado->nombre = $request->nombre;
            $aliado->razon_social = $request->razon_social;
            $aliado->url_foto_perfil  = Base64ToFile::storage($request->url_foto_perfil, '/aliados/nit-'.$request->nit);
            $aliado->url_foto_portada = Base64ToFile::storage($request->url_foto_portada, '/aliados/nit-'.$request->nit);
            $aliado->nit = $request->nit;
            $aliado->visible = $request->visible;
            $aliado->save();

            return response()->json([
                'success'=>true,
                'data'=>$aliado, 'message'=>'resolvio la petición'
            ], 200);

        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de AliadoConroller@store'
            ],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aliado  $aliado
     * @return \Illuminate\Http\Response
     */
    public function show($aliado)
    {
        try {
            $show = Aliado::find($aliado);
            return response()->json([
                'success' => true,
                'data' => $show, 'message' => 'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de AliadoConroller@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aliado  $aliado
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarAliadoRequest $request, $aliado)
    {
//    return $request;

        try{

            $user = Aliado::find($aliado);
            $user->nombre = $request->nombre;
            $user->razon_social = $request->razon_social;
            if($request->url_foto_perfil!='no'){ $user->url_foto_perfil  = Base64ToFile::storage($request->url_foto_perfil, '/aliados/nit-'.$request->nit);}{}
            if($request->url_foto_portada!='no'){ $user->url_foto_portada = Base64ToFile::storage($request->url_foto_portada, '/aliados/nit-'.$request->nit);}{}
            $user->nit = $request->nit;
//            $user->visible = $request->visible;
            $user->save();


//            $user = $request->all();
//            $user['url_foto_perfil'] = Base64ToFile::storage($request->url_foto_perfil, '/aliados/nit-'.$request->nit);
//            $user['url_foto_portada'] = Base64ToFile::storage($request->url_foto_portada, '/aliados/nit-'.$request->nit);
//            $userSaved = Aliado::where('id',$aliado);
//            $userSaved->update($user);

            return response()->json([
                'success' => true,
                'data' => 'ok', 'message' => 'resolvio la petición'
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
     * @param  \App\Aliado  $aliado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
           // DB::table('aliados')->where("id",'=',$aliado->id)->delete();
            //$aliado->destroy();
            $aliado = Aliado::destroy($id);
            return response()->json([
                'success'=>true,
                'data'=>$aliado, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de AliadoConroller@destroy'
            ],404);
        }
    }
}
