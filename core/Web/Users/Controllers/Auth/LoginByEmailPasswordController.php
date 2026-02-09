<?php

namespace Core\Web\Users\Controllers\Auth;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\Auth\AuthenticateUserAction;
use Core\Web\Users\Requests\Auth\LoginRequest;
use Core\Web\Users\Resources\VerifyResource;

class LoginByEmailPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        LoginRequest $request,
        AuthenticateUserAction $authenticateUserAction
    ) {
        return new VerifyResource(
            resource: $authenticateUserAction->execute(
                $request->validated('email'),
                $request->validated('password'),
            )
        );
    }
}
