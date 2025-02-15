<?php

namespace Packages\Auth\App\DTOs;

use Illuminate\Support\Arr;

final readonly class LoginPhoneDto
{
    public function __construct(
        public string $phone
    )
    {}

    /**
     * Create a new instance from validated data.
     *
     * @param array $validated
     * @return LoginPhoneDto
     */
    public static function fromValidated(array $validated): LoginPhoneDto
    {
        return new LoginPhoneDto(
            phone: Arr::get(array: $validated, key: "phone"),
        );
    }

    /**
     * Get the data as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            "phone" => $this->phone,
        ]);
    }
}
