<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Models\User;

final class ResendOtpAction
{
    public function __construct(private StoreOtpAction $storeOtpAction) {}

    public function execute(User $user): mixed
    {
        return $this->storeOtpAction->execute(user: $user);
    }
}
