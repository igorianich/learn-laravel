<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => ['required','string',Password::min(8)->letters()->numbers()->symbols()]
        ];
    }

    public function passedValidation(): void
    {
        $this->merge([
            'role' => 'user',
        ]);
    }
}
