<?php

namespace App\Http\Controllers;



//use App\AliadoCategoriaModel;
use App\AliadoCategoriaModel;
use App\AliadosCategorias;
use App\Categoria;
use App\Http\Requests\AliadoCategoriaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\DB;

class AliadoCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//         return    dd(\);
        try{
            if(request()->aliado=='1'){

                $id_aliado = Auth::user()->id_aliado;
                $aliadoCategoria = AliadosCategorias::where('id_aliado',$id_aliado);
                $index = Categoria::leftJoinSub($aliadoCategoria, 'aliado-categoria', function($join){
                    $join->on('categorias.id','=','aliado-categoria.id_categoria');
                })
                    ->select('categorias.*', 'aliado-categoria.estado','aliado-categoria.id as aliado_categoria_id')
                    ->orderBy('categorias.created_at')
                    ->paginate(20);

                return response()->json([
                    'success'=>true,
                    'data'=>$index, 'message'=>'resolvio la petición AliadoCategoriaController@index'
                ], 200);
            }else{

                $resp = AliadosCategorias::with('aliado')->where('estado',1)->where('id_categoria','=',request()->id_categoria)->paginate(20);

                return response()->json([
                    'success'=>true,
                    'data'=>$resp, 'message'=>'resolvio la petición AliadoCategoriaController@index'
                ],200);
            }


        }catch (\Exception $exception){
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción AliadoCategoriaController@index'
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AliadoCategoriaRequest $request)
    {
        try{
            $aliado= new AliadosCategorias ;
            $aliado->estado = $request->estado;
            $aliado->id_aliado = $request->id_aliado;
            $aliado->id_categoria = $request->id_categoria;
            $aliado->save();
            return response()->json([
                'success'=>true,
                'data'=>$aliado, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de AliadoCategoriaController@store'
            ],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AliadosCategorias  $aliadoCategoriaModel
     * @return \Illuminate\Http\Response
     */
    public function show( $aliadoCategoria )
    {
        try {
            $show = AliadosCategorias::find($aliadoCategoria);
            return response()->json([
                'success' => true,
                'data' => $show, 'message' => 'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de AliadoCategoriaController@show'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AliadosCategorias  $aliadoCategoriaModel
     * @return \Illuminate\Http\Response
     */
    public function update(AliadoCategoriaRequest $request,  $aliadoCategoriaModel)
    {
        try{
            $index = AliadosCategorias::where('id',$aliadoCategoriaModel)->update($request->all());
            return response()->json([
                'success'=>true,
                'data'=>$aliadoCategoriaModel, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de AliadoCategoriaController@update'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AliadosCategorias  $aliadoCategoriaModel
     * @return \Illuminate\Http\Response
     */
    public function destroy( $aliadoCategoriaModel)
    {
        try{

            // DB::table('aliados')->where("id",'=',$aliado->id)->delete();
            //$aliado->destroy();
            $sucursale =AliadosCategorias::destroy($aliadoCategoriaModel);
            return response()->json([
                'success'=>true,
                'data'=>$sucursale, 'message'=>'resolvio la petición'
            ], 200);
        }catch (\Exception $exception) {
            return  response()->json([
                'data'=>$exception,
                'success'=>false,
                'message'=>'Fallo de excepción de AliadoCategoriaController@destroy'
            ],404);
        }
    }
}
