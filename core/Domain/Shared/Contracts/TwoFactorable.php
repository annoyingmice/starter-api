<?php

namespace Core\Domain\Shared\Contracts;

interface TwoFactorable
{
    /**
     * Verify the provided code against the stored secret.
     */
    public function verifyOtp(string $code, int $window = 2): bool;
    /**
     * Get the current valid OTP code for the entity.
     */
    public function currentOtp(): string;
}
