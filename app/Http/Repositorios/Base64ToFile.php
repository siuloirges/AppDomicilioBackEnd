<?php

namespace App\Http\Repositorios;
use Illuminate\Support\Facades\Storage;

class Base64ToFile
{

    static function storage($imagenBase64, $path=null) {

        if($imagenBase64!=null&&$imagenBase64!='no'){

            $imageName = uniqid().'.jpg';
            $image  = base64_decode($imagenBase64);
            $path =  '/imagenes/'.($path ? $path . '/' : '');
            Storage::disk('local')->put( '/public'.$path.$imageName,$image );
            $url = '/storage'.$path.$imageName;
            return $url;

        }

        return null;
    }

    static function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'kilometers') {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        switch($unit) {
            case 'miles':
                break;
            case 'kilometers' : $distance = $distance * 1.609344;
        }
        return (round($distance,2));
    }

}

?>
