<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:5,100',
            'email' => 'required|email|unique:users,email|between:5,100',
            'password' => ['required','string',Password::min(8)->max(60)->letters()->numbers()->symbols()]
        ];
    }

    public function passedValidation(): void
    {
        $this->merge([
            'role' => 'user',
        ]);
    }
}
