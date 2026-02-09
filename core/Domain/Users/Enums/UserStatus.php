<?php

namespace Core\Domain\Users\Enums;

use Core\Domain\Shared\Traits\ArrayableEnum;

enum UserStatus: string
{
    use ArrayableEnum;

    case ACTIVE = "active";
    case INACTIVE = "inactive";
    case BANNED = "banned";
}
