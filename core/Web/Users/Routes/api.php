<?php

use Core\Web\Users\Controllers\Auth\{
    RegisterController,
    EmailVerifyController,
    LoginByEmailPasswordController,
    LoginByPhoneController,
    LogoutController,
    ResendOtpController,
    ResendVerificationController,
    VerifyOtpController
};
use Core\Web\Users\Controllers\UserController;
use Core\Web\Users\Middleware\AccountMustActiveMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function() {
    Route::post(
        "credentials",
        LoginByEmailPasswordController::class
    );
    Route::post(
        uri: "login-phone",
        action: LoginByPhoneController::class
    );
    Route::post(
        uri: "register",
        action: RegisterController::class
    );
    Route::post(
        uri: "verify",
        action: VerifyOtpController::class
    );
    Route::post(
        uri: "resend/{user}",
        action: ResendOtpController::class
    );
    Route::post("logout", LogoutController::class)
        ->middleware("auth:sanctum");
});

Route::get(
    uri: "email/verify/{user}/{hash}",
    action: EmailVerifyController::class
)
    ->middleware("signed")
    ->name("verification.verify");

Route::post(
    uri: "/email/verification-notification/{user}",
    action: ResendVerificationController::class
)
    ->middleware("throttle:6,1")
    ->name("verification.send");

Route::middleware(["auth:sanctum", AccountMustActiveMiddleware::class])
    ->group(function () {
        Route::apiResource(
            name: "users",
            controller: UserController::class
        );
    });
