<?php

namespace Core\App\Users\Actions\Auth;

use Core\App\Addresses\Actions\UpdateOrCreateAddressAction;
use Core\App\Emails\Actions\UpdateOrCreateEmailAction;
use Core\App\Phones\Actions\UpdateOrCreatePhoneAction;
use Core\App\Users\DTOs\UserDto;
use Core\Domain\Users\Events\UserRegistered;
use Core\Domain\Users\Models\User;
use Core\Web\Shared\Responses\ResponseError;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class RegisterUserAction
{
    public function __construct(
        private UpdateOrCreateEmailAction $updateOrCreateEmailAction,
        private UpdateOrCreatePhoneAction $updateOrCreatePhoneAction,
        private UpdateOrCreateAddressAction $updateOrCreateAddressAction,
    ) {}

    /**
     * Execute the action with the given data.
     *
     * @return \Packages\User\App\Models\User
     */
    public function execute(UserDto $data): User
    {
        DB::beginTransaction();
        try {
            $user = User::create(
                attributes: Arr::except(
                    array: $data->toArray(),
                    keys: ["email", "phone", "address"]
                )
            );

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

            $this->eventSendEmailVerification(user: $user);

            DB::commit();

            return $user->load([
                "email",
                "phone",
                "address"
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new ResponseError(
                customMessage: $e->getMessage(),
                section: "Packages\User\App\Actions\RegisterUserAction::execute()"
            );
        }
    }

    private function eventSendEmailVerification(User $user): void
    {
        event(new UserRegistered($user));
    }
}
