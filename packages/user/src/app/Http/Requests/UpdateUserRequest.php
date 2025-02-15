<?php

namespace Packages\User\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Packages\User\App\Enums\UserStatus;

class UpdateUserRequest extends FormRequest
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
            "first_name" => ["nullable", "string"],
            "middle_name" => ["nullable", "string"],
            "last_name" => ["nullable", "string"],
            "phone_number" => ["nullable", "numeric", "unique:users,id"],
            "email" => ["nullable", "email", "unique:users,id"],
            "password" => ["nullable", "confirmed", "string"],
            "status" => ["nullable", Rule::enum(UserStatus::class)],
        ];
    }
}
