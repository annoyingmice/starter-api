<?php

namespace Packages\Otp\App\Actions;

use Packages\Otp\App\DTOs\VerifyOtpDto;
use Packages\Otp\App\Http\Responses\ResponseError;
use Packages\User\App\Models\User;

final class VerifyOtpAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @return mixed
     */
    public function execute(VerifyOtpDto $data): mixed
    {
        $user = User::findBySlug(slug: $data->userSlug);

        if (!$user->verifyOtp(code: $data->secret)) {
            throw new ResponseError(
                customMessage: "Invalid OTP code please try again.",
                section: "Packages\Store\App\Actions::VerifyOtpAction()"
            );
        }

        $expiration = now()->addHours(
            value: (int) config("otp.token_expires_in_hours")
        );

        return (object) [
            "user" => $user,
            "token" => $user->createToken(
                name: "authToken",
                abilities: [],
                expiresAt: $expiration
            )->plainTextToken,
            "expires_at" => $expiration,
        ];
    }
}
