<?php

namespace Packages\User\App\Actions;

use Packages\User\App\Events\Registered;
use Packages\User\App\Models\User;
use Packages\User\App\DTOs\RegisterUserDto;

final class RegisterUserAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @return \Packages\User\App\Models\User
     */
    public function execute(User $user, RegisterUserDto $dto): User
    {
        $user = $user->create(
            attributes: $dto->toArray()
        );

        $this->eventSendEmailVerification(user: $user);

        return $user;
    }

    /**
     * Send email verification event.
     *
     * @param \Packages\User\App\Models\User $user
     * @return void
     */
    private function eventSendEmailVerification(User $user): void
    {
        event(new Registered($user));
    }
}
