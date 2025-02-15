<?php

use Illuminate\Support\Facades\Route;
use Packages\User\App\Http\Controllers\EmailNoticeController;
use Packages\User\App\Http\Controllers\EmailVerificationNotificationController;
use Packages\User\App\Http\Controllers\EmailVerifyController;
use Packages\User\App\Http\Controllers\RegisterController;
use Packages\User\App\Http\Controllers\UserController;

Route::post("register", RegisterController::class);
Route::get("email/verify", EmailNoticeController::class)->name(
    "verification.notice"
);
Route::get("email/verify/{user}/{hash}", EmailVerifyController::class)
    ->middleware("signed")
    ->name("verification.verify");

Route::middleware("auth:sanctum")->group(function () {
    Route::post(
        "/email/verification-notification/{user}",
        EmailVerificationNotificationController::class
    )
        ->middleware("throttle:6,1")
        ->name("verification.send");

    Route::apiResource("users", UserController::class);
});
