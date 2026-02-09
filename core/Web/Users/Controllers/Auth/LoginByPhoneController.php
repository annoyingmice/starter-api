<?php

namespace Core\Web\Users\Controllers\Auth;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\Auth\LoginByPhoneAction;
use Core\Web\Users\Requests\Auth\LoginByPhoneRequest;
use Core\Web\Users\Resources\OtpResource;

class LoginByPhoneController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        LoginByPhoneRequest $request,
        LoginByPhoneAction $loginPhoneAction
    ) {
        return new OtpResource(
            resource: $loginPhoneAction->execute(
                countryCode: $request->validated('country_code'),
                number: $request->validated('phone')
            )
        );
    }
}
