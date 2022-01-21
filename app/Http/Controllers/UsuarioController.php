<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\Base64ToFile;
use App\Http\Requests\ActualizarUsuarioRequest;
use App\Http\Requests\UsuarioRequest;
use App\Producto;
use App\Sucursales;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\Cast\Object_;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        try{

            if(request()->id_aliado!=null){
                $index = Usuario::where('id_aliado',request()->id_aliado)->paginate(20);
            }else{
                $index = Usuario::paginate(20);
            }

            return response()->json(['success'=>true,'data'=>$index, 'message'=>'resolvio la peticion'],200);

        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción UsuarioController@index'],404);
        }

//        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {

        try{

            $user = new Usuario;
            $user->nombre = $request->nombre;
            $user->numero_documento = $request->numero_documento;
            $user->telefono = $request->telefono;
            $user->email = $request->email;
            $user->url_foto_perfil = Base64ToFile::storage($request->url_foto_perfil, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->password =  Hash::make($request->password);

            $user->placa_vehiculo = $request->placa_vehiculo;
            $user->foto_documento_identidad_1 = Base64ToFile::storage($request->foto_documento_identidad_1, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->foto_documento_identidad_2 =  Base64ToFile::storage($request->foto_documento_identidad_2, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->foto_targeta_propiedad_1 = Base64ToFile::storage($request->foto_targeta_propiedad_1, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->foto_targeta_propiedad_2 = Base64ToFile::storage($request->foto_targeta_propiedad_2, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->foto_soat_1 = Base64ToFile::storage($request->foto_soat_1, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->foto_soat_2 = Base64ToFile::storage($request->foto_soat_2, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->foto_vehiculo_1 = Base64ToFile::storage($request->foto_vehiculo_1, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->foto_vehiculo_2 =Base64ToFile::storage($request->foto_vehiculo_2, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);
            $user->rol = $request->rol;

            $user->tipo_vehiculo_id = $request->tipo_vehiculo_id;
            $user->tipo_documento_id=$request->tipo_documento_id;
            $user->rol_id = $request->rol_id;
            $user->id_aliado = $request->id_aliado;
            $user->id_sucursal = $request->id_sucursal;
            $user->save();



                if($request->rol=='asistente'){

                    $getUser = Usuario::where('numero_documento',$request->numero_documento)->first();

                    $sucursale = Sucursales::find($request->id_sucursal);

                    $sucursale->id_asistente = $getUser->id;

                    $sucursale->update();

                }

//            $show =

            return response()->json(['success'=>true,'data'=>$user, 'message'=>'resolvio la petición'],200);
        }   catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción UsuarioController@store'],404);
        }


//        dd($user);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
//        dd($id ->id);
        try{
            $show = $usuario;
            //$user = Usuario::find($id);
            return response()->json(['success'=>true,'data'=>$show, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción UsuarioController@show'],404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarUsuarioRequest $request, $usuario)
    {
        try{

            $user = Usuario::find($usuario);
          if($request->nombre!=null){  $user->nombre = $request->nombre;}
          if($request->numero_documento!=null){  $user->numero_documento = $request->numero_documento;}
          if($request->telefono!=null){ $user->telefono = $request->telefono;}
          if($request->email!=null){  $user->email = $request->email;}
          if($request->url_foto_perfil!='no'){$user->url_foto_perfil = Base64ToFile::storage($request->url_foto_perfil, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);}
          if($request->password!=null){$user->password =  Hash::make($request->password);}

          if($request->placa_vehiculo!=null){  $user->placa_vehiculo = $request->placa_vehiculo;}
          if($request->foto_documento_identidad_1!='no'){  $user->foto_documento_identidad_1 = Base64ToFile::storage($request->foto_documento_identidad_1, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);}
          if($request->foto_documento_identidad_2!='no'){  $user->foto_documento_identidad_2 =  Base64ToFile::storage($request->foto_documento_identidad_2, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento); }

          if($request->foto_targeta_propiedad_1!='no'){$user->foto_targeta_propiedad_1 = Base64ToFile::storage($request->foto_targeta_propiedad_1, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);}
          if($request->foto_targeta_propiedad_2!='no'){  $user->foto_targeta_propiedad_2 = Base64ToFile::storage($request->foto_targeta_propiedad_2, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);}
          if($request->foto_soat_1!='no'){$user->foto_soat_1 = Base64ToFile::storage($request->foto_soat_1, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);}
          if($request->foto_soat_2!='no'){$user->foto_soat_2 = Base64ToFile::storage($request->foto_soat_2, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);}
          if($request->foto_vehiculo_1!='no'){  $user->foto_vehiculo_1 = Base64ToFile::storage($request->foto_vehiculo_1, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);}
          if($request->foto_vehiculo_2!='no'){$user->foto_vehiculo_2 =Base64ToFile::storage($request->foto_vehiculo_2, 'usuarios/'.$request->rol.'/doc-'.$request->numero_documento);}
          if($request->rol!=null){ $user->rol = $request->rol;}

          if($request->tipo_vehiculo_id!=null){  $user->tipo_vehiculo_id = $request->tipo_vehiculo_id;}
          if($request->tipo_documento_id!=null){$user->tipo_documento_id=$request->tipo_documento_id;}
          if($request->rol_id!=null){$user->rol_id = $request->rol_id;}
          if($request->id_aliado!=null){$user->id_aliado = $request->id_aliado;}
          if($request->id_sucursal!=null){$user->id_sucursal = $request->id_sucursal;}

            $user->save();


            return response()->json(['success'=>true,'data'=>$user, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción UsuarioController@update'],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
//            $id_asistente = Usuario::where('id','=',$id)->select('id')->first();

//
//            return response()->json(['success'=>true,'data'=>$id_asistente->id_sucursal, 'message'=>'resolvio la petición'], 200);
//            if($id_asistente!=null){

              $sucursal = Sucursales::where('id_asistente','=',$id)->first();

              if($sucursal!=null){

                  $sucursal = Sucursales::find($sucursal->id);
                  $sucursal->id_asistente=null;
                  $sucursal->estado='no_disponible';
                  $sucursal->update();
//                  return response()->json(['success'=>true,'data'=>$sucursal, 'message'=>'resolvio la petición'], 200);

              }
        $user = Usuario::destroy($id);
        return response()->json(['success'=>true,'data'=>$user, 'message'=>'resolvio la petición'], 200);
        }catch (\Exception $exception) {
            return  response()->json(['data'=>$exception->getMessage(),'success'=>false,'message'=>'Fallo de excepción de UsuarioController@destroy'],404);
        }
    }
}
