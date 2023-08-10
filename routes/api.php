<?php

use App\Http\Controllers\Api\V1\ComponentController;
use App\Http\Controllers\Api\V1\FormController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::namespace('App\Http\Controllers\Api')->name('api.')->group(function ($router) {
    Route::namespace('V1')->prefix('v1')->name('v1.')->group(function (){
        Route::name('auth.')->group(function () {
            Route::post('/register', 'AuthController@register')->name('register');
            Route::post('/login', 'AuthController@login')->name('login');
        });

        Route::middleware('auth:sanctum')->group(function () {

            Route::prefix('components')->name('component.')->group(function () {
                Route::get('/', 'ComponentController@getAll')->name('all');
            });

            Route::prefix('forms')->name('form')->group(function () {
                Route::post('/create', 'FormController@create')->name('create');
            });

        });
    });
});
