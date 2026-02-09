<?php

declare(strict_types=1);

namespace Core\App\Addresses\Actions;

use Core\App\Addresses\DTOs\AddressDto;
use Core\Domain\Addresses\Models\Address;

class UpdateAddressAction
{
    public function execute(Address $address, AddressDto $data): Address
    {
        return tap($address)->update($data->toArray())->fresh();
    }
}
