<?php

declare(strict_types=1);

namespace Core\App\Emails\Actions;

use Core\App\Emails\DTOs\EmailDto;
use Core\Domain\Emails\Models\Email;
use Illuminate\Database\Eloquent\Model;

class UpdateOrCreateEmailAction
{
    public function execute(Model $model, EmailDto $data): Email
    {
        return $model->emails()->updateOrCreate(
            ['slug' => $model->email->slug],
            $data->toArray()
        );
    }
}
