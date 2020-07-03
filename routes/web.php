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
    Route::group(['middleware' => ['web', 'auth']], function () {
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

    Route::namespace ('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });
});

Route::group([
    'prefix' => 'cs',
    'as' => 'cs.',
    'namespace' => 'CustomerService',
], function () {
    Route::get('/', 'CustomerService\QueueController@index')->name('index');

    Route::namespace ('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
