<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/register', 'UserController@register');
Route::post('/register', [UserController::class, 'register']);
Route::post('/send', [MessageController::class, 'insertMessages']);

Route::post('/messege/{id}', [MessageController::class, 'delete']);
Route::get('/messages', [MessageController::class, 'getMessages']);
