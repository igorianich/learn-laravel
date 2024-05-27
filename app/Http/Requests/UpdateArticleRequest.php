<?php

namespace App\Http\Requests;

use App\Enums\ArticleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'max:50'],
            'text' => ['sometimes', 'max:10000'],
            'image' => ['nullable', 'sometimes'],
            'status' => ['sometimes', Rule::enum(ArticleStatus::class)],
            'slug' => ['sometimes'],
        ];
    }
}
