<?php

namespace Packages\Otp\App\DTOs;

use Illuminate\Support\Arr;

final readonly class VerifyOtpDto
{
    public function __construct(
        public string $userSlug,
        public string $secret,
    )
    {}

    /**
     * Create a new instance from validated data.
     *
     * @param array $validated
     * @return VerifyOtpDto
     */
    public static function fromValidated(array $validated): VerifyOtpDto
    {
        return new VerifyOtpDto(
            userSlug: Arr::get(array: $validated, key: "user_slug"),
            secret: Arr::get(array: $validated, key: "otp"),
        );
    }

    /**
     * Get the data as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "user_slug" => $this->userSlug,
            "secret" => $this->secret,
        ];
    }
}
