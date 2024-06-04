<?php

namespace App\Models\Builders;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

/** @mixin Article */
class ArticleBuilder extends Builder
{
    public function isPublished(?bool $bool): self
    {
        return $this->when(
            !is_null($bool),
            fn (self $q) => $q->where('status', $bool ? ArticleStatus::Published : ArticleStatus::Draft)
        );
    }

}
