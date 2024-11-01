<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatroomController;
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
Route::post('/chatrooms', [ChatroomController::class, 'createChatroom']);
Route::get('/chatrooms', [ChatroomController::class, 'listChatrooms']);
Route::post('/chatrooms/{id}/enter', [ChatroomController::class, 'enterChatroom']);
Route::post('/chatrooms/{id}/leave', [ChatroomController::class, 'leaveChatroom']);
Route::post('/chatrooms/{id}/message', [ChatroomController::class, 'sendMessage']);
Route::get('/chatrooms/{id}/messages', [ChatroomController::class, 'listMessages']);



