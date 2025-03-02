<?php

namespace Packages\User\App\Enums;

use Packages\User\App\Enums\Concerns\ArrayableEnum;

enum UserStatus: string
{
    use ArrayableEnum;

    case ACTIVE = "active";
    case INACTIVE = "deactivated";
}
