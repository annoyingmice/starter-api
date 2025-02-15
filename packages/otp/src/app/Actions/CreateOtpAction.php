<?php

namespace Packages\Otp\App\Actions;

use Packages\Otp\App\Models\Otp;
use Packages\User\App\Models\User;

final class CreateOtpAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @return \Packages\Otp\App\Models\Otp
     */
    public function execute(User $user): Otp
    {
        return $user
            ->otps()
            ->create(attributes: ["code" => $user->currentOtp()])
            ->load("user");
    }
}
