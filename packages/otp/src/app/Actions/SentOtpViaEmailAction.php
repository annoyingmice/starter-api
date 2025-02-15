<?php

namespace Packages\Otp\App\Actions;

use Illuminate\Support\Facades\Mail;
use Packages\Otp\App\Mail\OtpGenerated;
use Packages\Otp\App\Models\Otp;
use Packages\User\App\Models\User;

final class SentOtpViaEmailAction
{
    public function __construct()
    {
    }

    /**
     * Execute the action with the given data.
     *
     * @param \Packages\User\App\Models\User $user
     * @param \Packages\Otp\App\Models\Otp $otp
     * @return void
     */
    public function execute(User $user, Otp $otp): void
    {
        if($user->hasVerifiedEmail())
        {
            Mail::to($user->email)->sendNow(new OtpGenerated($otp));
        }
    }
}
