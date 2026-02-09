<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Models\User;
use Core\Web\Shared\Responses\ResponseError;
use Illuminate\Support\Facades\Hash;

final class AuthenticateUserAction
{
    public function execute(string $email, string $password): mixed
    {
        $user = User::with(["address", "email", "phone"])
        ->whereHas(
            "email",
            fn ($query) => $query->where("email", $email)
        )->first();

        if(!$user) {
            throw new ResponseError(
                customMessage: "Invalid email or password",
                section: "Core\App\Users\Actions\Auth\LoginByEmailPasswordAction::execute()"
            );
        }

        if(!Hash::check($password, $user->password)) {
            throw new ResponseError(
                customMessage: "Invalid email or password",
                section: "Core\App\Users\Actions\Auth\LoginByEmailPasswordAction::execute()"
            );
        }

        $expiration = now()->addHours(24);

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
