<?php

use App\Http\Controllers\ITechGroupController;
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

//ITech group routes
Route::get('groups', [ITechGroupController::class, 'index']);
Route::get('groups/{id}', [ITechGroupController::class, 'show']);
Route::post('group', [ITechGroupController::class, 'store']);
Route::post('notify/{code}', [ITechGroupController::class, 'sendNotification']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
