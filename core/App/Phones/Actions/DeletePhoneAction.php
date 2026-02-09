<?php

declare(strict_types=1);

namespace Core\App\Phones\Actions;

use Core\Domain\Phones\Models\Phone;

class DeletePhoneAction
{
    public function execute(Phone $phone): Phone
    {
        return tap($phone)->delete();
    }
}
