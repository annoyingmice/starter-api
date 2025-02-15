<?php

namespace Packages\User\App\Actions;

use Illuminate\Support\Facades\DB;
use Packages\User\App\Models\User;

final class DeleteUserAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @param \Packages\User\App\Models\User $user
     * @return \Packages\User\App\Models\User|null
     */
    public function execute(User $user): User
    {
        return tap($user)->delete();
    }
}
