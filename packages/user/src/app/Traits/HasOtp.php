<?php

namespace Packages\User\App\Traits;

use PragmaRX\Google2FA\Google2FA;

trait HasOtp
{
    /**
     * Boot the trait and assign UUID during model creation.
     *
     * @return void
     */
    protected static function bootHasOtp(): void
    {
        static::creating(function ($model) {
            if (empty($model->otp_secret)) {
                $model->otp_secret = (new Google2FA())->generateSecretKey();
            }
        });
    }

    /**
     * Verify the OTP code.
     *
     * @param string $code
     * @param ?int $window
     * @return bool
     */
    public function verifyOtp(string $code, int $window = 2): bool
    {
        return (new Google2FA())->verifyKey(
            secret: $this->otp_secret,
            key: $code,
            window: $window
        );
    }

    /**
     * Generate a new OTP code.
     *
     * @return string
     */
    public function currentOtp(): string
    {
        return (new Google2FA())->getCurrentOtp(secret: $this->otp_secret);
    }
}
