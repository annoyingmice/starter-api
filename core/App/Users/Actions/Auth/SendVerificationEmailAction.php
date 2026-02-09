<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Models\User;

final class SendVerificationEmailAction
{
    public function execute(User $user): void
    {
        $user->sendEmailVerificationNotification();
    }
}
