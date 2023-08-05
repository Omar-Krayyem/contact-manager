<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::group(['prefix' => 'contacts'], function(){
    Route::get('all', [ContactController::class, "getAll"]);
    Route::get('/{contact}', [ContactController::class, "getById"]);
    Route::post('/store', [ContactController::class, "store"]);
    Route::post('/update', [ContactController::class, "update"]);
    Route::get('destroy/{contact}', [ContactController::class, "destroy"]);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
