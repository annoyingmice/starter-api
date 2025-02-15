<?php

namespace Packages\Otp\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Packages\User\App\Http\Resources\UserResource;

class OtpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "slug" => $this->slug,
            "user" => new UserResource($this->whenLoaded('user')),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
