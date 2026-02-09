<?php

declare(strict_types=1);

namespace Core\App\Phones\Actions;

use Core\App\Phones\DTOs\PhoneDto;
use Core\Domain\Phones\Models\Phone;
use Illuminate\Database\Eloquent\Model;

class UpdateOrCreatePhoneAction
{
    public function execute(Model $model, PhoneDto $data): Phone
    {
        return $model->phones()->updateOrCreate(
            ['slug' => $model->phone->slug],
            $data->toArray()
        );
    }
}
