<?php

namespace App\Http\Repositorios;

use App\Usuario;
use Illuminate\Foundation\Auth\User;

class FCM
{

    static function captureFcmToken($fcmToken, $username)
    {
        $usuario = Usuario::where('email', $username)->first();
        $usuario->fcm_token = $fcmToken;
        $usuario->save();
    }


    static function sendNotificationById($id)
    {
        $fcmToken = User::find($id)->first()['fcm_token'];
        FCM::sendNotification($fcmToken);
    }


    static function sendNotification($fcmToken, $title = "Novedades en tu pedido", $body = "Abrir para mas informacion",$request='{}',$tipo='comun')
    {
        try {

//           $data= json_encode($request);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "rules_version": "2",
                    "notification": {
                        "body": "' . $body . '",
                        "title": "' . $title . '",
                       
                        
                    },
                    "priority": "high",
                    "data": {
                        "click_action": "FLUTTER_NOTIFICATION_CLICK",
                        "body": "' . $body . '",
                        "title": "' . $title . '",
                        "data": '. $request .',
                        "tipo":"'.$tipo.'",
                       

                    },
                    "to": "'.$fcmToken.'"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key=' . env('FIREBASE_TOKEN', 'AAAA2StkLw0:APA91bGGMOmdmvW5ETgXCM40fXc-_1nkyNqxmm6VNP8lTZovov3MX2RxffGBB3aSLk0a62Y1HHuR37CZsvGxkRU8vPkkrUVtxP_Zh0JNusc1X1UgfZ42CokejTReffbehg-xgXbvjLd5'),
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            echo $response;
//            echo $request;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
