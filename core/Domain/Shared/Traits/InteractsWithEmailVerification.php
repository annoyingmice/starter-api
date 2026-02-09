<?php

namespace Core\Domain\Shared\Traits;

trait InteractsWithEmailVerification
{
    public function hasVerifiedEmail(): bool
    {
        // Safety check in case the relationship isn't loaded or exists
        return $this->email && ! is_null($this->email->email_verified_at);
    }

    public function markEmailAsVerified(): bool
    {
        return $this->email->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function getEmailForVerification(): string
    {
        return $this->email->email;
    }

    /**
     * This is the fix for your RFC 2822 error!
     */
    public function routeNotificationForMail($notification): string
    {
        return $this->email->email;
    }
}
