<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/people', [PersonController::class, 'index']);
Route::post('/people', [PersonController::class, 'store']);
Route::get('/people/{id}', [PersonController::class, 'show']);
Route::put('/people/{id}', [PersonController::class, 'update']);
Route::delete('/people/{id}', [PersonController::class, 'destroy']);

Route::get('/families', [FamilyController::class, 'index']);
Route::post('/families', [FamilyController::class, 'store']);
Route::get('/families/{id}', [FamilyController::class, 'show']);
Route::put('/families/{id}', [FamilyController::class, 'update']);
Route::delete('/families/{id}', [FamilyController::class, 'destroy']);
