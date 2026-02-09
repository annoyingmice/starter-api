<?php

namespace Core\App\Addresses\DTOs;

use Illuminate\Support\Arr;

final readonly class AddressDto
{
    public function __construct(
        public string $addressLine1,
        public ?string $addressLine2,
        public string $city,
        public string $state,
        public string $postalCode,
        public string $country,
        public string $latitude,
        public string $longitude,
        public bool $primary,
    ) { }

    public static function fromArray(array $data): AddressDto
    {
        return new AddressDto(
            addressLine1: Arr::get(array: $data, key: 'address_line_1'),
            addressLine2: Arr::get(array: $data, key: 'address_line_2', default: null),
            city: Arr::get(array: $data, key: 'city'),
            state: Arr::get(array: $data, key: 'state'),
            postalCode: Arr::get(array: $data, key: 'postal_code'),
            country: Arr::get(array: $data, key: 'country'),
            latitude: Arr::get(array: $data, key: 'latitude'),
            longitude: Arr::get(array: $data, key: 'longitude'),
            primary: Arr::get(array: $data, key: 'primary', default: true)
        );
    }

    public function toArray(): array
    {
        return [
            'address_line_1' => $this->addressLine1,
            'address_line_2' => $this->addressLine2,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postalCode,
            'country' => $this->country,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'primary' => $this->primary
        ];
    }
}
