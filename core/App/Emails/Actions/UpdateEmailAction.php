<?php

declare(strict_types=1);

namespace Core\App\Emails\Actions;

use Core\App\Emails\DTOs\EmailDto;
use Core\Domain\Emails\Models\Email;

class UpdateEmailAction
{
    public function execute(Email $email, EmailDto $data): Email
    {
        return tap($email)->update($data->toArray())->fresh();
    }
}
