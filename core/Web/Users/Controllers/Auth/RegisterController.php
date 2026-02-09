<?php

namespace Core\Web\Users\Controllers\Auth;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\Auth\RegisterUserAction;
use Core\App\Users\DTOs\UserDto;
use Core\Web\Users\Requests\Auth\RegisterRequest;
use Core\Web\Users\Resources\UserResource;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request, RegisterUserAction $registerUserAction)
    {
        return new UserResource(
            resource: $registerUserAction->execute(
                data: UserDto::fromArray(
                    data: $request->validated()
                ),
            )
        );
    }
}
