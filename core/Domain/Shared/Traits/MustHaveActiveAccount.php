<?php

declare(strict_types=1);

namespace Core\Domain\Shared\Traits;

use Core\Domain\Users\Enums\UserStatus;

trait MustHaveActiveAccount
{
    public function markAccountActive(): void
    {
        $this->status = UserStatus::ACTIVE->value;

        if (method_exists($this, 'save')) {
            $this->save();
        }
    }

    public function isActive(): bool
    {
        return $this->status === UserStatus::ACTIVE;
    }
}
