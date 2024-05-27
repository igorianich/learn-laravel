<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case Draft = 'draft';
    case Published = 'published';

    public function isPublished(): bool
    {
        return self::Published === $this;
    }
}
