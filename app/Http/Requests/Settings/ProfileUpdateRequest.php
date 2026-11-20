<?php

namespace App\Http\Requests\Settings;

use App\Concerns\ProfileValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    use ProfileValidationRules;

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if (config('fortify.lowercase_usernames') && is_string($this->input('email'))) {
            $this->merge(['email' => Str::lower($this->input('email'))]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            ...$this->profileRules($this->user()->id),
            // A new login email needs the password, or a borrowed session could take the account
            // over for good through "forgot password".
            'current_password' => [Rule::requiredIf($this->changesEmail()), 'nullable', 'string', 'current_password'],
        ];
    }

    public function changesEmail(): bool
    {
        return Str::lower((string) $this->input('email')) !== Str::lower((string) $this->user()->email);
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return ['current_password' => 'kata sandi saat ini'];
    }
}
