<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);

Route::get('dummy-profile', function () {
    return view('dummy-profile');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
], function () {
    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('/', 'HomeController@index')->name('index');

        Route::group(['prefix' => 'customer-services', 'as' => 'cs.'], function () {
            Route::get('/', 'CustomerServiceController@index')->name('index');
            Route::get('/create', 'CustomerServiceController@create')->name('create');
            Route::post('/create', 'CustomerServiceController@store');
            Route::get('/{customerService}/edit', 'CustomerServiceController@edit')->name('edit');
            Route::put('/{customerService}', 'CustomerServiceController@update');
            Route::delete('/{customerService}/delete', 'CustomerServiceController@destroy');
        });

        Route::group(['prefix' => 'counters', 'as' => 'counter.'], function () {
            Route::get('/', 'CounterController@index')->name('index');
            Route::get('/create', 'CounterController@create')->name('create');
            Route::post('/create', 'CounterController@store');
            Route::get('/{counter}/edit', 'CounterController@edit')->name('edit');
            Route::put('/{counter}', 'CounterController@update');
            Route::delete('/{counter}/delete', 'CounterController@destroy');
        });
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::get('/logout', 'LoginController@logout')->name('logout');
    });
});

Route::group([
    'prefix' => 'cs',
    'as' => 'cs.',
    'namespace' => 'CustomerService',
], function () {
    Route::group(['middleware' => ['auth:cs']], function () {
        Route::get('/', 'QueueController@index')->name('index');
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::get('/logout', 'LoginController@logout')->name('logout');
    });
    Route::get('/not_supported', function () {
        return view('cs.not_supoorted');
    })->name('not_supported');
});

Route::get('/home', 'HomeController@index')->name('home');
