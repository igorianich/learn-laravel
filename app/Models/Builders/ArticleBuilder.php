<?php

namespace App\Models\Builders;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

/** @mixin Article */
class ArticleBuilder extends Builder
{
    public function isPublished(?bool $bool):self
    {
        if ($bool === null){
            return $this;
        }

        return $this->where('status', $bool ? 'published' : 'draft');
    }

}
