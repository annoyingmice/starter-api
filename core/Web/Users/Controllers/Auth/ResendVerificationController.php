<?php

namespace Core\Web\Users\Controllers\Auth;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\Auth\SendVerificationEmailAction;
use Core\Domain\Users\Models\User;
use Core\Web\Users\Resources\EmailNoticeResource;

class ResendVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        User $user,
        SendVerificationEmailAction $sendVerificationEmail
    ) {
        $sendVerificationEmail->execute(user: $user);

        return new EmailNoticeResource(resource: []);
    }
}
