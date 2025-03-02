<?php

namespace Packages\Starter\App\Enums\Concerns;

trait ArrayableEnum
{
    public static function toArray(): array
    {
        if (method_exists(object_or_class: static::class, method: "cases")) {
            return array_column(array: self::cases(), column_key: "value");
        }

        return [];
    }
}
