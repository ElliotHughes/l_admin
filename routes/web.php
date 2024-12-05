<?php

use Illuminate\Support\Facades\Route;

Route::post('/user/login','App\Http\Controllers\Api\User@index')->name('User.index');
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->namespace('App\Http\Controllers\Api')->group(function () {
    Route::get('/home','AdminHome@index')->name('AdminHome.index');
    Route::get('/brother-list','AdminHome@brotherList')->name('AdminHome.brotherList');
});
Route::any('{any}', [App\Http\Controllers\EmptyRouteController::class, 'handle'])->where('any', '.*');
