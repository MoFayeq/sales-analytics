<?php

use App\Http\Controllers\IntegrationsController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);

Route::get('/integrations/analyze-orders', [IntegrationsController::class, 'analyzeOrders']);
Route::get('/integrations/weather-promo', [IntegrationsController::class, 'weatherPromotion']);
