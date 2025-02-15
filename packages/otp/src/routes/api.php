<?php

use Illuminate\Support\Facades\Route;
use Packages\Otp\App\Http\Controllers\VerifyOtpController;

Route::post(
    uri: "auth/verify",
    action: VerifyOtpController::class
);
