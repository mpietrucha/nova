<?php

namespace Mpietrucha\Nova\Components\Tag;

use Mpietrucha\Nova\Components\Tag;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Str;

class Script extends Tag
{
    public function index(EnumerableInterface $lines): ?int
    {
        return $lines->filter->is('*<script src="*"></script>')->keys()->last();
    }

    public function render(string $content): string
    {
        return Str::sprintf('%s<script>%s</script>', Str::tab(), $content);
    }
}
