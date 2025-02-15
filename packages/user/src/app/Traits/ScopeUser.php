<?php

namespace Packages\User\App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ScopeUser
{
    /**
     * Filter by phone number
     *
     * @param string $phone
     * @return void
     */
    public function scopeWherePhone(Builder $query, string $phone): void
    {
        $query->where(column: "phone_number", operator: "=", value: $phone);
    }
}
