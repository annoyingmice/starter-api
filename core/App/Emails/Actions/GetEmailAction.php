<?php

declare(strict_types=1);

namespace Core\App\Emails\Actions;

use Core\Domain\Emails\Models\Email;

class GetEmailAction
{
    public function execute(Email $email): Email
    {
        return $email;
    }
}
