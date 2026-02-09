<?php

namespace Core\App\Users\Actions;

use Core\Domain\Users\Models\User;

final class GetUserAction
{
    public function execute(User $user): User
    {
        return $user->load([
            "email",
            "phone",
            "address"
        ]);
    }
}
