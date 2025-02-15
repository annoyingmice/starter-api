<?php

namespace Packages\User\App\DTOs;

use Illuminate\Support\Arr;
use Packages\User\App\Enums\UserStatus;

final readonly class UpdateUserDto
{
    public function __construct(
        public ?string $first_name,
        public ?string $middle_name,
        public ?string $last_name,
        public ?string $phone_number,
        public ?string $email,
        public ?string $password,
        public ?UserStatus $status
    ) {
    }

    /**
     * @param array {
     *  first_name?: string
     *  middle_name?: string
     *  last_name?: string
     *  phone_number?: string
     *  email?: string
     *  password?: string
     *  status?: string
     * } $data
     * @return UpdateUserDto
     */
    public static function fromValidated(array $data): UpdateUserDto
    {
        return new UpdateUserDto(
            first_name: Arr::get(array: $data, key: "first_name", default: null),
            middle_name: Arr::get(
                array: $data,
                key: "middle_name",
                default: null
            ),
            last_name: Arr::get(array: $data, key: "last_name", default: null),
            phone_number: Arr::get(array: $data, key: "phone_number", default: null),
            email: Arr::get(array: $data, key: "email", default: null),
            password: Arr::get(array: $data, key: "password", default: null),
            status: UserStatus::from(
                value: Arr::get(
                    array: $data,
                    key: "status",
                    default: UserStatus::ACTIVE->value
                )
            )
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            "first_name" => $this->first_name,
            "middle_name" => $this->middle_name,
            "last_name" => $this->last_name,
            "phone_number" => $this->phone_number,
            "email" => $this->email,
            "password" => $this->password,
            "status" => $this->status->value,
        ]);
    }
}
