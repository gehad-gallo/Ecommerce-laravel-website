<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


//note that the prefix is admin for all file route

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'guest:admin','prefix'=> 'admin'], function () {

        //make perfix here is better for run the package without execption

        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@postLogin')->name('admin.post.login');

    });




    Route::group(['namespace' =>'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function(){    

        Route::get('/','DashboardController@index')->name('admin.dashboard');

        Route::group(['prefix' => 'settings'], function(){
            Route::get('shipping/{type}','SettingsController@editShippingMethods') -> name('shipping_method');
            Route::put('shipping/{id}','SettingsController@updateShippingMethods') -> name('update_shipping_method');
        });


    });

});