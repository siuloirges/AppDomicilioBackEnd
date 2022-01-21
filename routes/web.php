<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $query = http_build_query([
        'client_id' => 't3hNCFHulhHUrAEvjyDKRqyHn5V3wHxvzqyPSEAu',
        'redirect_uri' => 'http://traeloo_database.test/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://traeloo_database.test/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $state = $request->session()->pull('state');

//    throw_unless(
//        strlen($state) > 0 && $state === $request->state,
//        InvalidArgumentException::class
//    );

    $http = new GuzzleHttp\Client;

    $response = $http->post('http://traeloo_database.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '7',
            'client_secret' => 't3hNCFHulhHUrAEvjyDKRqyHn5V3wHxvzqyPSEAu',
            'redirect_uri' => 'http://example.com/callback',
            'code' => 1,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});