<?php

use App\Http\Controllers\OrderController;
use App\Livewire\OrderComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', function () {
    return view('orders');
}); // let's learn edit
