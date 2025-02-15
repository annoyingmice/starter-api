<?php

namespace Packages\User\App\Actions;

use Packages\User\App\Http\Requests\EmailVerificationRequest;

final class EmailVerifyAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @param EmailVerificationRequest $request
     * @return void
     */
    public function execute(EmailVerificationRequest $request): void
    {
        $request->fulfill();
    }
}
