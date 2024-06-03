<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use App\Models\Builders\ArticleBuilder;
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
    //TODO: add image stuff

    protected $casts = [
        'status' => ArticleStatus::class,
        'published_at' => 'datetime',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function newEloquentBuilder($query): ArticleBuilder
    {
        return new ArticleBuilder($query);
    }
}
