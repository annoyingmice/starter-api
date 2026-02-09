<?php

namespace Core\Web\Emails\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
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
            "emailable" => $this->whenLoaded("emailable"),
            "email" => $this->email,
            "email_verified_at" => $this->email_verified_at,
            "primary" => $this->primary,
        ];
    }
}
