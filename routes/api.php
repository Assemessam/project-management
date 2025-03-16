<?php

use App\Http\Controllers\Api\OccupationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/occupations', [OccupationController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
