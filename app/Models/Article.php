<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{

    protected $fillable = [
        'title',
        'text',
        'image',
        'status',
        'slug'
    ];

    protected $casts = [
        'status' => ArticleStatus::class
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
