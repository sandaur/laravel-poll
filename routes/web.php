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

/*Votation subdomains handdler */
Route::group(['domain' => '{subdom}.laravel.test'], function () {
    Route::get('/', function ($subdom) {
        return "This is {$subdom} subdomain.";
    });
});

/*Administrative site */
Route::group(['domain' => 'laravel.test'], function () {
    Route::get('/', function () {
        return Redirect::to('/home');
    });

    Route::get('/newlogin', function () {
        return View::make('auth.newlogin');
    });

    /*Logged users Only */
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', 'HomeController@index')->name('home');
        
        Route::get('/votation/{pollid}/options', 'OptionController@create')->name('create-option');
        Route::post('/votation/{pollid}/options/store', 'OptionController@store')->name('store-option');
        Route::delete('/votation/{pollid}/options/remove', 'OptionController@destroy')->name('delete-option');

        Route::post('/votation/store', 'VotationController@store')->name('new-votation');
        Route::delete('/votation/remove', 'VotationController@destroy')->name('del-votation');

        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    });

    /*Non logged users Only */
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'Auth\LoginController@authForm');

        Route::post('/login', 'Auth\LoginController@authenticate')->name('login');
    });
});

/**
 * TODO: Añadir middleware para comprobar permisos sobre los recursos de la web.
 */