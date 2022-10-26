<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('get-all',[TodoController::class,"getAll"]);
    Route::post('todo',[TodoController::class,"createTodo"]);
    Route::delete('todo',[TodoController::class,"deleteTodo"]);
    Route::patch('todo',[TodoController::class,"updateTodo"]);
    });

    

Route::post("login",[UserController::class,'index']);