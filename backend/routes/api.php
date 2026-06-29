<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\VisitsController;
use Illuminate\Routing\Route;

Route::apiResource('products', ProductController::class);
// Route::get('/visits/{id}', [VisitsController::class, 'show']);
Route::apiResource('visits', VisitsController::class);