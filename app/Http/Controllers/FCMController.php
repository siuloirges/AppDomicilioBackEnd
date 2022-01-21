<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\FCM;
use App\Usuario;
use Illuminate\Http\Request;

class FCMController extends Controller
{
    public function fcmTest($request)
    {
//        $request  =
        return FCM::sendNotification($request->fcm_token,$request->title, $request->body, $request->data);
    }

    public function unsetFcm()
    {
        try {
            $usuario = Usuario::where('fcm_token', request()->fcm_token)->first();
            $usuario->fcm_token = null;
            $usuario->save();
            return ["success" => true];
        } catch (\Throwable $th) {
            return ["success" => false, "error" => $th->getMessage()];
        }
    }
}
