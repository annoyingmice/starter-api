<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Events\EmailVerified;
use Core\Web\Users\Requests\Auth\EmailVerificationRequest;

final class EmailVerifyAction
{
    public function __construct()
    {
    }

    public function execute(EmailVerificationRequest $request): void
    {
        $request->fulfill();

        event(new EmailVerified($request->getVerifiedUser()));
    }
}
