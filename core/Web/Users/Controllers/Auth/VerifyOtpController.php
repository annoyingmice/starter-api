<?php

namespace Core\Web\Users\Controllers\Auth;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\Auth\VerifyOtpAction;
use Core\Web\Users\Requests\Auth\VerifyOtpRequest;
use Core\Web\Users\Resources\VerifyResource;

class VerifyOtpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyOtpRequest $request, VerifyOtpAction $verifyOtpAction)
    {
        return new VerifyResource(
            resource: $verifyOtpAction->execute(
                slug: $request->validated('user_slug'),
                code: $request->validated('code')
            )
        );
    }
}
