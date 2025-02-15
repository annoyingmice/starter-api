<?php

use Illuminate\Support\Facades\Route;
use Packages\Auth\App\Http\Controllers\LoginByPhoneController;
use Packages\Auth\App\Http\Controllers\LogoutController;

Route::prefix("auth")->group(function () {
    Route::post("phone", LoginByPhoneController::class);
    Route::post("logout", LogoutController::class)->middleware("auth:sanctum");
});
