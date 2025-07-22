<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LombaApiController;
use App\Http\Controllers\Api\NilaiApiController;
use App\Http\Controllers\Api\PanitiaApiController; 
use App\Http\Controllers\Api\PesertaApiController; 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/lombas', [LombaApiController::class, 'index']);
Route::get('/nilais', [NilaiApiController::class, 'index']);
Route::get('/panitias', [PanitiaApiController::class, 'index']);
Route::post('/pesertas', [PesertaApiController::class, 'store']);