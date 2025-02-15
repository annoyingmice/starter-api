<?php

namespace Packages\User\App\Http\Controllers;

use Packages\User\App\Actions\RegisterUserAction;
use Packages\User\App\Http\Requests\RegisterRequest;
use Packages\User\App\DTOs\RegisterUserDto;
use Packages\User\App\Http\Resources\UserResource;
use Packages\User\App\Http\Responses\ResponseCreated;
use Packages\User\App\Models\User;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request, User $user, RegisterUserAction $registerUserAction)
    {
        $user = $registerUserAction->execute(
            user: $user,
            dto: RegisterUserDto::fromValidated(
                data: $request->validated()
            ),
        );

        return new ResponseCreated(
            message: "Registered successfully",
            resource: new UserResource(
                resource: $user
            )
        );
    }
}
