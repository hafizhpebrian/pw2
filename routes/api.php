<?php

use App\Http\Controllers\API\FakultasController;
use App\Http\Controllers\API\ProdiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fakultas', [FakultasController::class, 'index']);
Route::get('/prodi', [ProdiController::class, 'index']);
Route::post('/fakultas', [FakultasController::class,'store']);
Route::post('/prodi', [ProdiController::class,'store']);
Route::patch('/fakultas/{id}', [FakultasController::class, 'update']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);