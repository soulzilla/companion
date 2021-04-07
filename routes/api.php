<?php

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

use App\Http\Controllers\FileController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::post('/file/upload', [FileController::class, 'store']);
Route::delete('/file/delete', [FileController::class, 'destroy']);

Route::get('/main', [MainController::class, 'index']);
Route::get('/training', [MainController::class, 'training']);
Route::get('/command', [MainController::class, 'commands']);
Route::get('/interviews', [MainController::class, 'interviews']);
Route::get('/interview/{id}', [MainController::class, 'interview']);
Route::get('/visits', [MainController::class, 'visits']);
Route::get('/map', [MainController::class, 'show']);
