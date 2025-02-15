<?php

namespace Packages\Auth\App\Actions;

use Packages\User\App\Models\User;

final class LogoutAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @param \Packages\User\App\Models\User $user
     * @return array
     */
    public function execute(User $user): User
    {
        $this->logout($user);

        return $user;
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}
