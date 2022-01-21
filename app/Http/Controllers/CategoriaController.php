<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Repositorios\Base64ToFile;
use App\Http\Requests\ActualizarCategoriaRequest;
use App\Http\Requests\CategoriaRequest;

use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            if(\request()->admin=='1'){
                $index = Categoria::get();
                $total = 0;
                foreach ($index as $i) {

                    $total=$total+1;
                }

                return response()->json([
                    'success'=>true,
                    'data'=>$total, 'message'=>'resolvio la petición'
                ], 200);
            }

            $index = Categoria::paginate(20);
            return response()->json([
                'success'=>true,
                'data'=>$index, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception){
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción CategoriaController@index'
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        try{
            $categoria=new Categoria;
            $categoria->titulo = $request->titulo;
            $categoria->descripcion = $request->descripcion;
         if($request->url_imagen!=null){
             $categoria->url_imagen = Base64ToFile::storage($request->url_imagen, 'categoria/');
         }
            $categoria->save();
            return response()->json([
                'success'=>true,
                'data'=>$categoria, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de CategoriaConroller@store'
            ],404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categorium)
    {
        try {


            $show = Categoria::find($categorium);
            return response()->json([
                'success' => true,
                'data' => $show, 'message' => 'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de CategoriaConroller@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarCategoriaRequest $request,  $id)
    {

//       return dd($id);

        try{

            $categoria= Categoria::find($id);
            $categoria->titulo = $request->titulo;
            $categoria->descripcion = $request->descripcion;
          if($request->url_imagen!='no'){ $categoria->url_imagen = Base64ToFile::storage($request->url_imagen, 'categoria/');}
            $categoria->save();

            return response()->json([
                'success'=>true,
                'data'=>$categoria, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de CategoriaConroller@update'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            // DB::table('aliados')->where("id",'=',$aliado->id)->delete();
            //$aliado->destroy();
            $categorium = Categoria::destroy($id);
            return response()->json([
                'success'=>true,
                'data'=>$categorium, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de CategoriaConroller@destroy'
            ],404);
        }
    }
}
