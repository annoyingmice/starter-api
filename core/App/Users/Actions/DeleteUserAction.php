<?php

namespace Core\App\Users\Actions;

use Core\Domain\Users\Models\User;

final class DeleteUserAction
{
    public function execute(User $user): User
    {
        return tap($user)->delete();
    }
}
