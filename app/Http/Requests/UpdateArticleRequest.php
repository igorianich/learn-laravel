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
            'title' => ['sometimes'],
            'text' => ['sometimes'],
            'image' => ['nullable', 'sometimes'],
            'status' => ['sometimes', Rule::enum(ArticleStatus::class)],
            'slug' => ['sometimes'],
        ];
    }
}
