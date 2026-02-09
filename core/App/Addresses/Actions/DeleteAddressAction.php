<?php

declare(strict_types=1);

namespace Core\App\Addresses\Actions;

use Core\Domain\Addresses\Models\Address;

class DeleteAddressAction
{
    public function execute(Address $address): Address
    {
        return tap($address)->delete();
    }
}
