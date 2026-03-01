<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiLoginController;

Route::post('login', [ApiLoginController::class, 'login']);
Route::middleware('auth:sanctum')->get('/users/nicks', function () {
    return \App\Models\User::pluck('nick');
});