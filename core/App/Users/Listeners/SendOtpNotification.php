<?php

namespace Core\App\Users\Listeners;

use Core\App\Users\Actions\Auth\SendOtpViaEmailAction;
use Core\Domain\Users\Events\OtpGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOtpNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct(private SendOtpViaEmailAction $sendOtpViaEmail)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OtpGenerated $event): void
    {
        // Send the OTP to the user's registered email address
        $this->sendOtpViaEmail->execute(
            user: $event->otp->user,
            otp: $event->otp
        );
    }
}
