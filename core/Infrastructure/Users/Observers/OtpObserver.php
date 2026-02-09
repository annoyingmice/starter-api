<?php

namespace Core\Infrastructure\Users\Observers;

use Core\Domain\Users\Events\OtpGenerated;
use Core\Domain\Users\Models\Otp;

class OtpObserver
{
    /**
     * Handle the Otp "created" event.
     */
    public function created(Otp $otp): void
    {
        event(new OtpGenerated($otp));
    }

    /**
     * Handle the Otp "updated" event.
     */
    public function updated(Otp $otp): void
    {
        //
    }

    /**
     * Handle the Otp "deleted" event.
     */
    public function deleted(Otp $otp): void
    {
        //
    }

    /**
     * Handle the Otp "restored" event.
     */
    public function restored(Otp $otp): void
    {
        //
    }

    /**
     * Handle the Otp "force deleted" event.
     */
    public function forceDeleted(Otp $otp): void
    {
        //
    }
}
