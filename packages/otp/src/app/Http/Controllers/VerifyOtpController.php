<?php

namespace Packages\Otp\App\Http\Controllers;

use Packages\Otp\App\Http\Resources\VerifyResource;
use Packages\Otp\App\Actions\VerifyOtpAction;
use Packages\Otp\App\DTOs\VerifyOtpDto;
use Packages\Otp\App\Http\Requests\VerifyOtpRequest;

class VerifyOtpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyOtpRequest $request, VerifyOtpAction $verifyOtpAction)
    {
        return new VerifyResource(
            resource: $verifyOtpAction->execute(
                data: VerifyOtpDto::fromValidated(
                    validated: $request->validated()
                )
            )
        );
    }
}
