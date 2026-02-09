<?php

namespace Core\Domain\Shared\Traits;

use Core\Domain\Phones\Models\Phone;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasPhone
{
    public function phones(): MorphMany
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function phone(): MorphOne
    {
        return $this->morphOne(Phone::class, 'phoneable')
            ->where('primary', true)
            ->withDefault();
    }
}
