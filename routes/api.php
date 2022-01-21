
<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login','AuthController@login');
Route::post('/refresh','AuthController@refresh');

Route::middleware('auth:api')->group(function () {

    Route::get('/logout','AuthController@logout');
    Route::resource('/user','UsuarioController');
    Route::get('/get_user',function (){
        
        try{
            return  response()->json(['success'=>true,'data'=> auth()->user(), 'message'=>'resolvio la petición'],200);
        }catch (\Exception $exception){
            return  response()->json(['success'=>false,'data'=> auth()->user(), 'message'=>'fallo la petición @get_user '],500);
        }

    });

    Route::resource('/producto', 'ProductoController');

    Route::resource('/direcciones', 'DireccionController');

    Route::resource('/sucursales','SucursaleController');

    Route::resource('/categoria_sucursales','CategoriaSucursalesController');

    Route::resource('/existencia','ExistenciaController');

    Route::resource('/categorias','CategoriaController');

    Route::resource('/AliadoCategorias','AliadoCategoriaController');

    Route::resource('/pedido', 'PedidoController');

    Route::resource('/aliado', 'AliadoController');

    Route::post('/update_location','RastreoController@store');

    Route::resource('/wallets', 'WalletController');

});

Route::resource('/versiones', 'VersioneController');

Route::resource('/movimientos', 'MovimientosController');

Route::resource('/evaluar_repartidor', 'EvaluacionRepartidorController');

Route::resource('/tipo_documentos','TipoDocumentoController');

Route::resource('/tipo_vehiculo','TipoVehiculoController');

Route::post('/post_user','UsuarioController@store');

Route::post('/post_aliados','AliadoController@store');

Route::resource('/detallePedidos', 'DetallePedidoController');

Route::resource('/pedidoUsuario', 'PedidoUsuarioController');

Route::resource('/contacto', 'ContactoController');

Route::resource('/TipoDirecciones','TipoDireccionesController');

Route::resource('/consultas','ConsultaController');

Route::post('/fcm_test', 'FCMController@fcmTest');

Route::post('/unset_fcm','FCMController@unsetFcm');








