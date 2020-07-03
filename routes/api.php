<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'queue'], function () {
    Route::get('stats', [
        'uses' => 'API\QueueController@stats',
    ]);

    Route::get('current/{counter}', [
        'uses' => 'API\QueueController@current',
    ]);

    Route::post('process/{counter}', [
        'uses' => 'API\QueueController@process',
    ]);

    Route::post('confirm/{customer}', [
        'uses' => 'API\QueueController@confirm',
    ]);

    Route::post('skip/{customer}', [
        'uses' => 'API\QueueController@skipQueue',
    ]);

    Route::post('finish/{customer}', [
        'uses' => 'API\QueueController@finish',
    ]);
});

Route::post('scan', [
    'uses' => 'API\ScannerController@scan',
]);
