<?php

namespace Packages\Auth\App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\Auth\App\Actions\LogoutAction;
use Packages\Auth\App\Http\Resources\LogoutResource;
use Packages\Auth\App\Http\Responses\ResponseSuccess;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, LogoutAction $logoutAction)
    {
        return new ResponseSuccess(
            message: "Account successfully logout.",
            resource: new LogoutResource(
                resource: $logoutAction->execute(user: request()->user())
            )
        );
    }
}
