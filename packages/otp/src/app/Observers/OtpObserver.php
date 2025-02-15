<?php

namespace Packages\Otp\App\Observers;

use Packages\Otp\App\Events\OtpRequested;
use Packages\Otp\App\Models\Otp;

class OtpObserver
{
    /**
     * Handle the Otp "created" event.
     */
    public function created(Otp $otp): void
    {
        event(new OtpRequested($otp));
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
