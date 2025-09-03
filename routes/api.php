<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\OCTApiController;
use App\Http\Controllers\Api\ProductCategorieController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('productCategory',ProductCategorieController::class);
Route::apiResource('product',ProductsController::class);
Route::apiResource('appointment',AppointmentController::class);
Route::apiResource('oct-analysis',OCTApiController::class);

