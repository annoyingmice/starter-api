<?php

namespace Packages\User\App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\User\App\Http\Resources\EmailNoticeResource;
use Packages\User\App\Http\Responses\ResponseSuccess;

class EmailNoticeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new ResponseSuccess(
            message: "Please verify your email address",
            resource: new EmailNoticeResource(resource: [])
        );
    }
}
