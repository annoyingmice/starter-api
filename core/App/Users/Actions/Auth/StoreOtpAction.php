<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Models\Otp;
use Core\Domain\Users\Models\User;

final class StoreOtpAction
{
    public function execute(User $user): Otp
    {
        return $user
            ->otps()
            ->create(attributes: ["code" => $user->currentOtp()])
            ->load(["user.email", "user.phone", "user.address"]);
    }
}
