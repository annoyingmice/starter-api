<?php

namespace Core\Web\Users\Requests\Auth;

use Core\Domain\Phones\Enums\PhoneCountryCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginByPhoneRequest extends FormRequest
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
            "country_code" => [
                "required",
                Rule::in(PhoneCountryCode::toArray())
            ],
            "phone" => [
                "required",
                "string"
            ],
        ];
    }
}
