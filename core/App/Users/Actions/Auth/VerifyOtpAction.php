<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Models\User;
use Core\Web\Shared\Responses\ResponseError;

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
    public function execute(string $slug, string $code): mixed
    {
        $user = User::findBySlug($slug);

        if (!$user->verifyOtp($code)) {
            throw new ResponseError(
                customMessage: "Invalid OTP code please try again.",
                section: "Packages\Store\App\Actions::VerifyOtpAction()"
            );
        }

        $expiration = now()->addHours(24);

        $user->loadMissing(["address", "email", "phone"]);

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
