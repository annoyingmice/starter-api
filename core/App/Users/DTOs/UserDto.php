<?php

namespace Core\App\Users\DTOs;

use Core\App\Addresses\DTOs\AddressDto;
use Core\App\Emails\DTOs\EmailDto;
use Core\App\Phones\DTOs\PhoneDto;
use Core\Domain\Users\Enums\UserStatus;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

final readonly class UserDto
{
    public function __construct(
        public string $first_name,
        public ?string $middle_name,
        public string $last_name,
        public PhoneDto $phone,
        public EmailDto $email,
        public string $password,
        public UserStatus $status,
        public AddressDto $address,
        public ?array $roles,
    ) {}

    /**
     * @param array {
     *  first_name: string
     *  middle_name?: string
     *  last_name: string
     *  phone_number: string
     *  email: string
     *  password: string
     *  status: string
     * } $data
     * @return UserDto
     */
    public static function fromArray(array $data): UserDto
    {
        return new UserDto(
            first_name: Arr::get(array: $data, key: "first_name"),
            middle_name: Arr::get(
                array: $data,
                key: "middle_name",
                default: null
            ),
            last_name: Arr::get(array: $data, key: "last_name"),
            phone: PhoneDto::fromArray(Arr::get(array: $data, key: "phone")),
            email: EmailDto::fromArray(Arr::get(array: $data, key: "email")),
            password: Arr::get(array: $data, key: "password", default: Hash::make(now()->toString())),
            status: UserStatus::from(
                value: Arr::get(
                    array: $data,
                    key: "status",
                    default: UserStatus::INACTIVE->value
                )
            ),
            address: AddressDto::fromArray(Arr::get(array: $data, key: "address")),
            roles: Arr::get(array: $data, key: "roles", default: null),
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
            "phone" => $this->phone->toArray(),
            "email" => $this->email->toArray(),
            "password" => $this->password,
            "status" => $this->status->value,
            "address" => $this->address->toArray(),
            "roles" => $this->roles,
        ]);
    }
}
