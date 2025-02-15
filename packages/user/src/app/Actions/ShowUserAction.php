<?php

namespace Packages\User\App\Actions;

use Packages\User\App\Models\User;

final class ShowUserAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @param string $slug
     * @return \Packages\User\App\Models\User
     */
    public function execute(User $user, array $relations = []): User
    {
        return $user->load(relations: $relations);
    }
}
