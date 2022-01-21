<?php

namespace App\Http\Controllers;

use App\Http\Requests\RastreoRequest;
use App\Rastreo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RastreoController extends Controller
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
    public function store(RastreoRequest $request)
    {
        try {
            $rastreo = new Rastreo();
            $rastreo->user_id = Auth::user()->id;
            $rastreo->latitude = $request->latitude;
            $rastreo->longitude = $request->longitude;
            $rastreo->save();
            return response()->json(['success' => true, 'data' => $rastreo, 'message' => 'resolvio la petición'], 200);
        } catch (\Exception $exception) {
            return  response()->json(['data' => $exception, 'success' => false, 'message' => 'Fallo de excepción RastreoController@store'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rastreo  $rastreo
     * @return \Illuminate\Http\Response
     */
    public function show(Rastreo $rastreo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rastreo  $rastreo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rastreo $rastreo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rastreo  $rastreo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rastreo $rastreo)
    {
        //
    }
}
