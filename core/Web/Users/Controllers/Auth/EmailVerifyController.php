<?php

namespace Core\Web\Users\Controllers\Auth;

use App\Http\Controllers\Controller;
use Core\App\Users\Actions\Auth\EmailVerifyAction;
use Core\Web\Users\Requests\Auth\EmailVerificationRequest;
use Illuminate\Http\Response;

class EmailVerifyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        EmailVerificationRequest $request,
        EmailVerifyAction $emailVerifyAction
    ) {
        $emailVerifyAction->execute(request: $request);

        return new Response(
            <<<HTML
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="UTF-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                        <title>Email Verified</title>

                        <!-- Tailwind CDN -->
                        <script src="https://cdn.tailwindcss.com"></script>
                    </head>

                    <body class="min-h-screen flex items-center justify-center bg-gray-50 text-gray-900">
                        <div class="text-center px-6 max-w-md">
                            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                                <!-- Success check icon -->
                                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>

                            <h1 class="text-2xl font-semibold mb-2">
                                Email Verified
                            </h1>

                            <p class="text-gray-600 mb-4">
                                Your email address has been successfully verified.
                            </p>

                            <p class="text-sm text-gray-500">
                                You may now safely close this window or return to the application.
                            </p>
                        </div>
                    </body>
                </html>
            HTML,
            200,
            ['Content-Type' => 'text/html']
        );
    }
}
