<?php

namespace App\Http\Controllers;
//namespace App\EvaluacionRepartidor;

use App\EvaluacionRepartidor;
use App\Usuario;
use Illuminate\Http\Request;

class EvaluacionRepartidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //id_repartidor id_cliente value
            $evaluacion = new EvaluacionRepartidor();
            $evaluacion->id_repartidor = $request->id_repartidor;
            $evaluacion->id_cliente = $request->id_cliente;
            $evaluacion->value = $request->value;
            $evaluacion->save();

            $evaluaciones = EvaluacionRepartidor::where('id_repartidor', $request->id_repartidor)->get();

            //  return $evaluaciones;    



            if ($evaluaciones != []) {
                $acumulado = 0;
                $totalEvaluaciones = sizeof($evaluaciones);


                foreach ($evaluaciones as $element) {

                    $acumulado +=  $element->value;
                }

                $puntuacionFinal = $acumulado / $totalEvaluaciones;

                $user = Usuario::find($request->id_repartidor);
                $user->calificacion = floatval($puntuacionFinal);
                $user->save();
                
               

                return response()->json(['success' => true, 'data' =>  "" , 'message' => 'resolvio la petición'], 200);
            }
        } catch (\Exception $exception) {
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción EvaluacionRepartidorController@store'],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EvaluacionRepartidor  $evaluacionRepartidor
     * @return \Illuminate\Http\Response
     */
    public function show( $evaluacionRepartidor)
    {

        // return $evaluacionRepartidor;
        try{
//
            $user = Usuario::where('id',$evaluacionRepartidor)->get();

            $data = [
                "repartidor"=>$user,
            ];
//
            return response()->json(['success'=>true,'data'=>$data, 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['data'=>$exception,'success'=>false,'message'=>'Fallo de excepción EvaluacionRepartidorController@show'],500);
        }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EvaluacionRepartidor  $evaluacionRepartidor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EvaluacionRepartidor $evaluacionRepartidor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EvaluacionRepartidor  $evaluacionRepartidor
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluacionRepartidor $evaluacionRepartidor)
    {
        //
    }
}
