<?php

namespace Packages\Auth\App\Actions;

use Exception;
use Packages\Auth\App\DTOs\LoginPhoneDto;
use Packages\Auth\App\Http\Responses\ResponseError;
use Packages\Otp\App\Actions\CreateOtpAction;
use Packages\Otp\App\Models\Otp;
use Packages\User\App\Models\User;

final class LoginPhoneAction
{
    public function __construct(private CreateOtpAction $createOtpAction)
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @param LoginPhoneDto $dto
     * @return object
     */
    public function execute(LoginPhoneDto $dto): object
    {
        return $this->loginPhone(phone: $dto->phone);
    }

    /**
     * Get the user information by phone number
     *
     * @param string $phone
     * @return \Packages\Otp\App\Models\Otp
     */
    public function loginPhone(string $phone): Otp
    {
        try {
            $user = User::wherePhone($phone)->firstOrFail();
            return $this->createOtpAction->execute(user: $user);
        } catch (Exception $e) {
            throw new ResponseError(
                customMessage: $e->getMessage(),
                section: "Packages\Auth\App\Actions::loginPhone()"
            );
        }
    }
}
