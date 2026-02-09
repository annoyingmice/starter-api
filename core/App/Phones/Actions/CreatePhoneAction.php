<?php

declare(strict_types=1);

namespace Core\App\Phones\Actions;

use Core\App\Phones\DTOs\PhoneDto;
use Core\Domain\Phones\Models\Phone;

class CreatePhoneAction
{
    public function execute(PhoneDto $data): Phone
    {
        return Phone::create($data->toArray());
    }
}
