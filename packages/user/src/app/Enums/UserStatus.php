<?php

namespace Packages\User\App\Enums;

enum UserStatus: string
{
    case ACTIVE = "active";
    case INACTIVE = "deactivated";
}
