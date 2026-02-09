<?php

declare(strict_types=1);

namespace Core\App\Emails\Actions;

use Core\App\Emails\DTOs\EmailDto;
use Core\Domain\Emails\Models\Email;

class CreateEmailAction
{
    public function execute(EmailDto $data): Email
    {
        return Email::create($data->toArray());
    }
}
