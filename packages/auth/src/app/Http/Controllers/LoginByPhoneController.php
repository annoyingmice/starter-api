<?php

namespace Packages\Auth\App\Http\Controllers;

use Packages\Auth\App\Actions\LoginPhoneAction;
use Packages\Auth\App\DTOs\LoginPhoneDto;
use Packages\Auth\App\Http\Requests\LoginPhoneRequest;
use Packages\Auth\App\Http\Responses\ResponseSuccess;
use Packages\Otp\App\Http\Resources\OtpResource;

class LoginByPhoneController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        LoginPhoneRequest $request,
        LoginPhoneAction $loginPhoneAction
    ) {
        return new ResponseSuccess(
            message: "Phone number logged in successfully.",
            resource: new OtpResource(
                resource: $loginPhoneAction->execute(
                    dto: LoginPhoneDto::fromValidated(
                        validated: $request->validated()
                    )
                )
            )
        );
    }
}
