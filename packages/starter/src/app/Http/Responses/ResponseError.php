<?php

declare(strict_types=1);

namespace Packages\User\App\Http\Responses;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ResponseError extends Exception
{
    /**
     * Create a new ResponseError instance.
     *
     * @param string $message
     * @param \Illuminate\Http\Resources\Json\JsonResource $resource
     */
    public function __construct(
        protected string $customMessage = "",
        protected string $section,
        protected int $statusCode = Response::HTTP_BAD_REQUEST
    ) {
        parent::__construct(
            message: $this->customMessage,
            code: $statusCode
        );
    }

    /**
     * Format the response as JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public function render(): JsonResponse
     {
        Log::debug(message: $this->section, context: $this->getTrace());

        return new JsonResponse([
            "message" => $this->customMessage,
            "data" => !app()->isProduction()
                    ? $this->getTrace()
                    : "Invalid request please try again",
        ], $this->statusCode);
     }
}
