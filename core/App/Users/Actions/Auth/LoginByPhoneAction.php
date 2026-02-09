<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Models\User;
use Core\Web\Shared\Responses\ResponseError;
use Exception;

final class LoginByPhoneAction
{
    public function __construct(private StoreOtpAction $createOtpAction)
    {
    }

    public function execute(string $countryCode, string $number): object
    {
        try {
            $user = User::whereHas(
                "phone",
                fn ($query) => $query->where([
                    "country_code" => $countryCode,
                    "number" => $number
                ])
            )->firstOrFail();

            return $this->createOtpAction->execute(user: $user);
        } catch (Exception $e) {
            throw new ResponseError(
                customMessage: $e->getMessage(),
                section: "Packages\Auth\App\Actions::loginPhone()"
            );
        }
    }
}
