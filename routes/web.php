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

$site = preg_replace('/http(s)?:\/\/(www.)?/', '', config('app.url'));

/*Administrative site */
$appRouting = function () {
    Route::get('/', function () {
        return Redirect::to('/votations');
    });
    
    /*Logged users Only */
    Route::group(['middleware' => 'auth'], function () {

        Route::get('votations', 'VotationController@index');
        /*API Calls */
        Route::get('/api/subdomav/{subdom}', 'VotationController@subdomAvailable');
        Route::get('/api/getpolls', 'VotationController@show');
        Route::post('/api/storepoll', 'VotationController@store');
        Route::delete('/api/deletepoll', 'VotationController@destroy');

        Route::post('/api/storecandidate', 'OptionController@store');
        Route::delete('/api/deletecandidate', 'OptionController@destroy');
        
        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    });
    
    /*Non logged users Only */
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'Auth\LoginController@authForm')->name('login-form');
        Route::post('/login/attempt', 'Auth\LoginController@authenticate')->name('login');
    });
};

/*Votation subdomains handdler */
$appSubdomRouting = function () {
    Route::get('/', function () {
        return '/ page';
    });
    
    Route::any('/urna', 'Auth\AuthController@responseOauth');
    Route::get('/{subdom}', 'UrnaController@index');

    Route::post('/cu/req', 'Auth\AuthController@requestOauth');
};


/*Domain redirection */
Route::group(['domain' => 'www.'.$site], $appRouting);
Route::group(['domain' => $site], $appRouting);

/* Temporal */ Route::group(['domain' => 'www.urnalp.test'], $appSubdomRouting);
/* Temporal */ Route::group(['domain' => 'urnalp.test'], $appSubdomRouting);

Route::group(['domain' => 'www.{subdom}.'.$site], $appSubdomRouting);
Route::group(['domain' => '{subdom}.'.$site], $appSubdomRouting);
