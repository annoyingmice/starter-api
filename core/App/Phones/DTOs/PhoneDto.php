<?php

namespace Core\App\Phones\DTOs;

use Illuminate\Support\Arr;

final readonly class PhoneDto
{
    public function __construct(
        public string $country_code,
        public string $number,
        public bool $primary,
    ) { }

    public static function fromArray(array $data): PhoneDto
    {
        return new PhoneDto(
            country_code: Arr::get(array: $data, key: "country_code"),
            number: Arr::get(array: $data, key: "number"),
            primary: Arr::get(array: $data, key: "primary")
        );
    }

    public function toArray(): array
    {
        return [
            "country_code" => $this->country_code,
            "number" => $this->number,
            "primary" => $this->primary
        ];
    }
}
