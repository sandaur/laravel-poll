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

        Route::get('/home', function(){return redirect('votations');})->name('home');

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

    /*Votations */
    Route::group(['prefix' => '/votacion/{pollName}'], function(){
        Route::get('', 'UrnaController@index');
        
        Route::any('/cu/req', 'Auth\AuthController@requestOauth');
        //Route::any('/urna', 'Auth\AuthController@responseOauth');
    });
};

/*Votation subdomains handdler */
$appSubdomRouting = function () {
    Route::get('/', 'UrnaController@index');
    
    Route::any('/cu/req', 'Auth\AuthController@requestOauth');
    Route::any('/urna', 'Auth\AuthController@responseOauth');

};


/*Domain redirection */
Route::group(['domain' => 'www.'.$site], $appRouting);
Route::group(['domain' => $site], $appRouting);

/* Temporal */ Route::group(['domain' => 'www.urnalp.test'], $appSubdomRouting);
/* Temporal */ Route::group(['domain' => 'urnalp.test'], $appSubdomRouting);

/* Route::group(['domain' => 'www.{subdom}.'.$site], $appSubdomRouting);
Route::group(['domain' => '{subdom}.'.$site], $appSubdomRouting); */
