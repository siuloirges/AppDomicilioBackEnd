<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\FCM;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
//        dd($request);
        $http = new \GuzzleHttp\Client;
        try {

            $response = $http->post( config('services.passport.login_endpoint'), [

                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ],

            ]);


            FCM::captureFcmToken($request->fcm_token, $request->username);


            return  json_decode((string) $response->getBody(), true);

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
//            dd($e);
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function refresh(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'refresh_token' => $request->refresh_token
                ]
            ]);

            return  json_decode((string) $response->getBody(), true);

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            //return response()->json([$e->getMessage()]);
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('The refresh token is invalid. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function logout()
    {
        $id = Auth::user()->id;

        $sucursal = Usuario::find($id);
        $sucursal->fcm_token=null;
        $sucursal->update();


        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }
}
