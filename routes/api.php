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

//Trainers
Route::prefix('posts')->group(function (){

    Route::get('',[\App\Http\Controllers\PostController::class,'all_show']);
    Route::post('create',[\App\Http\Controllers\PostController::class,'store']);
    Route::get('{post}',[\App\Http\Controllers\PostController::class,'single_show']);
    Route::get('delete/{id}',[\App\Http\Controllers\PostController::class,'single_delete']);
    Route::post('update/{post}',[\App\Http\Controllers\PostController::class,'update']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
