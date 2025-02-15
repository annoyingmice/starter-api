<?php

namespace Packages\User\App\Http\Controllers;

use Packages\User\App\Actions\EmailVerifyAction;
use Packages\User\App\Http\Requests\EmailVerificationRequest;
use Packages\User\App\Http\Resources\EmailVerifyResource;
use Packages\User\App\Http\Responses\ResponseSuccess;

class EmailVerifyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        EmailVerificationRequest $request,
        EmailVerifyAction $emailVerifyAction
    ) {
        $emailVerifyAction->execute(request: $request);

        return new ResponseSuccess(
            message: "Email successfully verified",
            resource: new EmailVerifyResource(resource: [])
        );
    }
}
