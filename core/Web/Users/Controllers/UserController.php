<?php

namespace Core\Web\Users\Controllers;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\{
    GetUserAction,
    StoreUserAction,
    UpdateUserAction,
    DeleteUserAction
};
use Core\App\Users\DTOs\UserDto;
use Core\Domain\Users\Models\User;
use Core\Web\Shared\Responses\ResponsePaginated;
use Core\Web\Users\Queries\UserIndexQuery;
use Core\Web\Users\Requests\StoreUserRequest;
use Core\Web\Users\Requests\UpdateUserRequest;
use Core\Web\Users\Resources\UserCollection;
use Core\Web\Users\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        UserIndexQuery $userIndexQuery
    ): ResponsePaginated {
        return new ResponsePaginated(
            resource: new UserCollection(
                resource: $userIndexQuery->paginate(
                    perPage: request()->get(key: "per_page", default: 10)
                )->withQueryString()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreUserRequest $request,
        StoreUserAction $storeUserAction
    ) {
        return new UserResource(
            resource: $storeUserAction->execute(
                data: UserDto::fromArray(
                    data: $request->validated()
                )
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(
        User $user,
        GetUserAction $getUserAction
    ) {
        return new UserResource(
            resource: $getUserAction->execute(user: $user)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateUserRequest $request,
        User $user,
        UpdateUserAction $updateUserAction
    ) {
        return new UserResource(
            resource: $updateUserAction->execute(
                user: $user,
                data: UserDto::fromArray(
                    data: $request->validated()
                )
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        User $user,
        DeleteUserAction $deleteUserAction
    ) {
        return new UserResource(
            resource: $deleteUserAction->execute(user: $user)
        );
    }
}
