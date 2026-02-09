<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Models\User;

final class LogoutAction
{
    public function execute(User $user): User
    {
        $user->tokens()->delete();

        return $user;
    }
}
