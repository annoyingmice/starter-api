<?php

namespace Packages\Otp\App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Packages\Otp\App\Actions\SentOtpViaEmailAction;
use Packages\Otp\App\Events\OtpRequested;

class SendRequestedOtp implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct(private SentOtpViaEmailAction $sendOtpViaEmail)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OtpRequested $event): void
    {
        // Send the OTP to the user's registered email address
        $this->sendOtpViaEmail->execute(
            user: $event->otp->user,
            otp: $event->otp
        );
    }
}
