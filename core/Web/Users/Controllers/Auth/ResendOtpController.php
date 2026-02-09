<?php

namespace Core\Web\Users\Controllers\Auth;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\Auth\ResendOtpAction;
use Core\Domain\Users\Models\User;
use Core\Web\Users\Resources\OtpResource;

class ResendOtpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, ResendOtpAction $resendOtpAction)
    {
        return new OtpResource(
            resource: $resendOtpAction->execute(
                user: $user
            )
        );
    }
}
