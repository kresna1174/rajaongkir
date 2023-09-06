<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FetchController;
use App\Http\Middleware\JWTMiddleware;
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

Route::post('login', [AuthController::class, 'attemp'])->name('login');

Route::middleware(JWTMiddleware::class)->group(function() {
    Route::prefix('search')->group(function() {
        Route::get('provinces', [FetchController::class, 'provinces'])->name('search.provinces');
        Route::get('cities', [FetchController::class, 'cities'])->name('cities');
    });
});
