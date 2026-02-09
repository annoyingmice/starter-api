<?php

namespace Core\Web\Users\Requests;

use Core\Domain\Users\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // @TODO: change this to check is user account is active
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => ["required", "string"],
            "middle_name" => ["nullable", "string"],
            "last_name" => ["required", "string"],
            "phone" => ["required", "array"],
            "phone.*" => ["required", "string"],
            "phone.number" => ["required", "string"],
            "phone.primary" => ["required", "boolean"],
            "email" => ["required", "array"],
            "email.*" => ["required", "email"],
            "email.primary" => ["required", "boolean"],
            "password" => ["required", "confirmed", "string"],
            "status" => ["sometimes", Rule::enum(UserStatus::class)],
            "address" => ["required", "array"],
            "address.*" => ["required", "string"],
            "address.address_line_2" => ["sometimes", "nullable", "string"],
            "address.postal_code" => ["required", "numeric"],
            "address.latitude" => ["required", "string"],
            "address.longitude" => ["required", "string"],
            "address.primary" => ["required", "boolean"],
            "roles" => ["sometimes", "array"],
            "roles.*" => ["string", "exists:roles,slug"],
        ];
    }
}
