<?php

declare(strict_types=1);

namespace Core\App\Phones\Actions;

use Core\App\Phones\DTOs\PhoneDto;
use Core\Domain\Phones\Models\Phone;

class UpdatePhoneAction
{
    public function execute(Phone $phone, PhoneDto $data): Phone
    {
        return tap($phone)->update($data->toArray())->fresh();
    }
}
