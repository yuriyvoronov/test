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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:sanctum')->get('tasks', 'App\Http\Controllers\TaskController@get');


Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('tasks', 'App\Http\Controllers\TaskController@get');
    Route::post('task', 'App\Http\Controllers\TaskController@post');
    Route::patch('task', 'App\Http\Controllers\TaskController@update');
    Route::delete('task', 'App\Http\Controllers\TaskController@delete');
    Route::patch('task/set_done', 'App\Http\Controllers\TaskController@set_done');
});

Route::get('user_token/{id}', 'App\Http\Controllers\UserController@make_token');