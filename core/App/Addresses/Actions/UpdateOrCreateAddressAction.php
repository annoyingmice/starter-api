<?php

declare(strict_types=1);

namespace Core\App\Addresses\Actions;

use Core\App\Addresses\DTOs\AddressDto;
use Core\Domain\Addresses\Models\Address;
use Illuminate\Database\Eloquent\Model;

class UpdateOrCreateAddressAction
{
    public function execute(Model $model, AddressDto $data): Address
    {
        return $model->addresses()->updateOrCreate(
            attributes: ["slug" => $model->address?->slug],
            values: $data->toArray()
        );
    }
}
