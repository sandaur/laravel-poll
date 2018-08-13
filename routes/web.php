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
        return Redirect::to('/home');
    });
    
    /*Logged users Only */
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/test/{page}', function ($page){
            return view("test.{$page}");
        });
        Route::get('/home', 'VotationController@index')->name('home');
        
        /*Votations */
        Route::post('/votation/store', 'VotationController@store')->name('new-votation');
        Route::delete('/votation/remove', 'VotationController@destroy')->name('del-votation');
        
        /*Votation Options
        *   Votation Security Policy Applied at OptionController construct
        */
        Route::group(['prefix' => '/votation/{pollid}/options'], function (){
            Route::get('/', 'OptionController@create')->name('create-option');
            Route::post('/store', 'OptionController@store')->name('store-option');
            Route::delete('/remove', 'OptionController@destroy')->name('delete-option');
        });
        
        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

        /*API Calls */
        Route::get('/api/subdomav/{subdom}', function($subdom) {
            $available = \App\Votation::isNameAvailable($subdom);
            return response()->json(compact("available"), 200);
        });

        Route::post('/api/storepoll', 'VotationController@store');
    });
    
    /*Non logged users Only */
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'Auth\LoginController@authForm')->name('login-form');
        Route::post('/login/attempt', 'Auth\LoginController@authenticate')->name('login');
    });
};

/*Votation subdomains handdler */
$appSubdomRouting = function () {
    Route::get('/', function ($subdom) {
        return redirect()->route('urna', [$subdom]);
    });

    Route::get('/urna', 'UrnaController@index')->name('urna');
};


/*Domain redirection */
Route::group(['domain' => 'www.'.$site], $appRouting);
Route::group(['domain' => $site], $appRouting);

Route::group(['domain' => 'www.{subdom}.'.$site], $appSubdomRouting);
Route::group(['domain' => '{subdom}.'.$site], $appSubdomRouting);
