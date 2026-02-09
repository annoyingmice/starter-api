<?php

namespace Core\App\Emails\DTOs;

use Illuminate\Support\Arr;

final readonly class EmailDto
{
    public function __construct(
        public string $email,
        public bool $primary,
    ) { }

    public static function fromArray(array $data): EmailDto
    {
        return new EmailDto(
            email: Arr::get(array: $data, key: "email"),
            primary: Arr::get(array: $data, key: "primary")
        );
    }

    public function toArray(): array
    {
        return [
            "email" => $this->email,
            "primary" => $this->primary
        ];
    }
}
