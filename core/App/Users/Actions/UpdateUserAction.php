<?php

namespace Core\App\Users\Actions;

use Core\App\Addresses\Actions\UpdateOrCreateAddressAction;
use Core\App\Emails\Actions\UpdateOrCreateEmailAction;
use Core\App\Phones\Actions\UpdateOrCreatePhoneAction;
use Core\App\Users\DTOs\UserDto;
use Core\Domain\Users\Models\User;
use Core\Web\Shared\Responses\ResponseError;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class UpdateUserAction
{
    public function __construct(
        private UpdateOrCreateEmailAction $updateOrCreateEmailAction,
        private UpdateOrCreatePhoneAction $updateOrCreatePhoneAction,
        private UpdateOrCreateAddressAction $updateOrCreateAddressAction
    ) {}

    public function execute(User $user, UserDto $data): User
    {
        DB::beginTransaction();
        try {
            $user = tap($user)->update(
                attributes: Arr::except(
                    array: $data->toArray(),
                    keys: ["email", "phone"]
                ),
            )
                ->fresh();

            $this->updateOrCreateEmailAction->execute(
                model: $user,
                data: $data->email,
            );

            $this->updateOrCreatePhoneAction->execute(
                model: $user,
                data: $data->phone,
            );

            $this->updateOrCreateAddressAction->execute(
                model: $user,
                data: $data->address,
            );

            DB::commit();

            return $user
                ->load([
                    "email",
                    "phone",
                    "address"
                ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new ResponseError(
                customMessage: $e->getMessage(),
                section: "Packages\User\App\Actions\UpdateUserAction::execute()"
            );
        }
    }
}
