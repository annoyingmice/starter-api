<?php

namespace Core\Domain\Shared\Traits;

use Core\Domain\Emails\Models\Email;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasEmail
{
    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function email(): MorphOne
    {
        return $this->morphOne(Email::class, 'emailable')
            ->where('primary', true)
            ->withDefault();
    }
}
