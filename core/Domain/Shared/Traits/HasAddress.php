<?php

namespace Core\Domain\Shared\Traits;

use Core\Domain\Addresses\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasAddress
{
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, "addressable");
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, "addressable")
            ->where("primary", true)
            ->withDefault();
    }
}
