<?php

namespace Packages\User\App\Actions;

use Illuminate\Support\Facades\DB;
use Packages\User\App\DTOs\UpdateUserDto;
use Packages\User\App\Models\User;

final class UpdateUserAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @param string $slug
     * @param \Packages\User\App\DTOs\UpdateUserDto $dto
     * @return \Packages\User\App\Models\User
     */
    public function execute(User $user, UpdateUserDto $dto): User
    {
        return tap($user)->update(
            attributes: $dto->toArray(),
        );
    }
}
