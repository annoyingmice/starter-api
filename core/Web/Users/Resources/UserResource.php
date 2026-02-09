<?php

namespace Core\Web\Users\Resources;

use Core\Web\Addresses\Resources\AddressResource;
use Core\Web\Emails\Resources\EmailResource;
use Core\Web\Phones\Resources\PhoneResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "first_name" => $this->first_name,
            "middle_name" => $this->middle_name,
            "last_name" => $this->last_name,
            "phone" => new PhoneResource(
                resource: $this->whenLoaded(
                    relationship: "phone"
                )
            ),
            "email" => new EmailResource(
                resource: $this->whenLoaded(
                    relationship: "email"
                )
            ),
            "address" => new AddressResource(
                resource: $this->whenLoaded(
                    relationship: "address"
                )
            ),
            "status" => $this->status,
            // "roles" => new RoleCollection(
            //     resource: $this->whenLoaded(
            //         relationship: "roles"
            //     )
            // ),
            // "company" => new CompanyResource(
            //     resource: $this->whenLoaded(
            //         relationship: "company"
            //     )
            // ),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
