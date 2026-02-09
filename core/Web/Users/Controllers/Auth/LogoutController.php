<?php

namespace Core\Web\Users\Controllers\Auth;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\Auth\LogoutAction;
use Core\Web\Users\Resources\UserResource;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, LogoutAction $logoutAction)
    {
        return new UserResource(
            resource: $logoutAction->execute(user: request()->user())
        );
    }
}
