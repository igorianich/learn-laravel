<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Str;

class ArticleObserver
{
    public function creating(Article $article): void
    {
        $article->slug = Str::slug($article->title) . '-' . time();
    }

    public function updating(Article $article): void
    {
        if ($article->status->isPublished() && $article->isDirty('status')) {
            $article->published_at = now();
        }
    }
}
