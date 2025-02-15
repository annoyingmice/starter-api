<?php

declare(strict_types=1);

namespace Packages\User\App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ResponseCreated extends JsonResponse
{
    /**
     * Create a new ResponseCreated instance.
     *
     * @param string $message
     * @param \Illuminate\Http\Resources\Json\JsonResource $resource
     */
    public function __construct(string $message, JsonResource $resource)
    {
        parent::__construct(
            data: [
                "message" => $message,
                "data" => $resource,
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
