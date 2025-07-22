<?php

use App\Http\Controllers\conversationsController;
use App\Http\Controllers\MessagesController;
use App\Models\conversation;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    route::get('conversation',[conversationsController::class,'index']);
    route::get('conversation/{conversation}',[conversationsController::class,'show']);
    route::post('conversation/{conversation}/participants',[conversationsController::class,'addParticipants']);
    route::delete('conversation/{conversation}/participants',[conversationsController::class,'removeParticipants']);
    route::get('conversations/{id}/messages',[MessagesController::class,'index']);
    route::post('messages',[MessagesController::class,'store'] )->name('api.messenger.store');
    route::delete('messages/{id}',[MessagesController::class,'destroy']);
    route::post('addParticipants',[conversationsController::class,'addParticipants']);
    });
