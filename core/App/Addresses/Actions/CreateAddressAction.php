<?php

declare(strict_types=1);

namespace Core\App\Addresses\Actions;

use Core\App\Addresses\DTOs\AddressDto;
use Core\Domain\Addresses\Models\Address;

class CreateAddressAction
{
    public function execute(AddressDto $data): Address
    {
        return Address::create($data->toArray());
    }
}
