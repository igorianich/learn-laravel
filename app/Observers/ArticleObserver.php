<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Str;

class ArticleObserver
{
    public function creating(Article $article): void
    {
        $slug = Str::slug($article->title);
        $slug .= '-' . now()->timestamp;
        $article->slug = $slug;
    }

    public function updated(Article $article): void
    {
        if ($article->status === 'published' && $article->isDirty('status')) {
            $article->published_at = now();
            $article->save();
        }
    }

    public function deleted(Article $article): void
    {
    }
}
