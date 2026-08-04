<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('meals')->controller(MealsController::class)->group(function(){
    Route::get('/','index');
    Route::get('/{meal}','show');
});

Route::prefix('meals')->middleware('auth:sanctum')->controller(MealsController::class)->group(function(){
    Route::post('/','store');
    Route::put('/{meal}','update');
    Route::delete('/{meal}','destroy');
});



Route::controller(AuthController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
});
Route::middleware('auth:sanctum')->controller(AuthController::class)->group(function(){
    Route::get('logout','logout');
});

