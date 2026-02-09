<?php

namespace Core\Web\Phones\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhoneResource extends JsonResource
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
            "phoneable" => $this->whenLoaded("phoneable"),
            "country_code" => $this->country_code,
            "number" => $this->number,
            "primary" => $this->primary,
        ];
    }
}
