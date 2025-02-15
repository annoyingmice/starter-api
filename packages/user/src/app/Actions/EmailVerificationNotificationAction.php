<?php

namespace Packages\User\App\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Packages\User\App\Models\User;

final class EmailVerificationNotificationAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @param \Packages\User\App\Models\User $user
     * @return void
     */
    public function execute(User $user): void
    {
        $user->sendEmailVerificationNotification();
    }
}
