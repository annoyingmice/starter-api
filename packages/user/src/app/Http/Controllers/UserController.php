<?php

namespace Packages\User\App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Packages\User\App\Actions\{
    StoreUserAction,
    DeleteUserAction,
    ListUsersAction,
    ShowUserAction,
    UpdateUserAction
};
use Packages\User\App\DTOs\{CreateUserDto, UpdateUserDto};
use Packages\User\App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use Packages\User\App\Http\Resources\{UserCollection, UserResource};
use Packages\User\App\Http\Responses\{
    ResponseCreated,
    ResponsePaginated,
    ResponseSuccess
};
use Packages\User\App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        User $user,
        ListUsersAction $listUsersAction
    ): ResponsePaginated {
        return new ResponsePaginated(
            resource: new UserCollection(
                resource: $listUsersAction->execute(user: $user)
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreUserRequest $request,
        User $user,
        StoreUserAction $storeUserAction
    ) {
        return new ResponseCreated(
            message: "Resource created successfully",
            resource: new UserResource(
                resource: $storeUserAction->execute(
                    user: $user,
                    dto: CreateUserDto::fromValidated(
                        data: $request->validated()
                    )
                )
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(
        User $user,
        ShowUserAction $showUserAction
    ): JsonResponse {
        return new ResponseSuccess(
            message: "Resource successfully fetched",
            resource: new UserResource(
                resource: $showUserAction->execute(user: $user)
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateUserRequest $request,
        User $user,
        UpdateUserAction $updateUserAction
    ): JsonResponse {
        return new ResponseSuccess(
            message: "Resource successfully updated",
            resource: new UserResource(
                resource: $updateUserAction->execute(
                    user: $user,
                    dto: UpdateUserDto::fromValidated($request->validated())
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
    ): JsonResponse {
        return new ResponseSuccess(
            message: "Resource successfully deleted",
            resource: new UserResource(
                resource: $deleteUserAction->execute(user: $user)
            )
        );
    }
}
