<?php

use App\Http\Middleware\GenerateTraceIdMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->namespace('App\Http\Controllers\Api')->middleware([
    GenerateTraceIdMiddleware::class,
])->group(function () {
    Route::get('/home','AdminHome@index')->name('AdminHome.index');
});
