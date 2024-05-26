<?php

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

Route::get('/plans', [\App\Http\Controllers\Api\PlanController::class, 'plans']);
Route::post('/getServerServicePrice', [\App\Http\Controllers\Api\PriceController::class, 'getServerPrice']);
Route::post('/orderServerService', [\App\Http\Controllers\Api\OrderController::class, 'order']);

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
