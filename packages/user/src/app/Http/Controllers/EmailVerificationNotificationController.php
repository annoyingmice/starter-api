<?php

namespace Packages\User\App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\User\App\Actions\EmailVerificationNotificationAction;
use Packages\User\App\Http\Resources\EmailNoticeResource;
use Packages\User\App\Http\Responses\ResponseSuccess;
use Packages\User\App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        User $user,
        EmailVerificationNotificationAction $emailVerificationNotificationAction
    ) {
        $emailVerificationNotificationAction->execute(user: $user);

        return new ResponseSuccess(
            message: "Verification link sent successfully",
            resource: new EmailNoticeResource(resource: [])
        );
    }
}
