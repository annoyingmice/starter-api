<?php

namespace Core\Web\Users\Middleware;

use Closure;
use Core\Domain\Users\Enums\UserStatus;
use Core\Web\Shared\Responses\ResponseError;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountMustActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->status->value !== UserStatus::ACTIVE->value)
        {
            throw new ResponseError(
                customMessage: "Account is not active please verify your email or contact admin.",
                section: "null"
            );
        }

        return $next($request);
    }
}
