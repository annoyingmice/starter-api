<?php

namespace Core\App\Users\Actions\Auth;

use Core\Domain\Users\Models\Otp;
use Core\Domain\Users\Models\User;
use Core\Infrastructure\Users\Mail\OtpGeneratedMail;
use Illuminate\Support\Facades\Mail;

final class SendOtpViaEmailAction
{
    public function execute(User $user, Otp $otp): void
    {
        if($user->hasVerifiedEmail())
        {
            Mail::to($user->email->email)->sendNow(new OtpGeneratedMail($otp));
        }
    }
}
