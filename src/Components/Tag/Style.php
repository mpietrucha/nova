<?php

namespace Mpietrucha\Nova\Components\Tag;

use Mpietrucha\Nova\Components\Tag;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Str;

class Style extends Tag
{
    public function index(EnumerableInterface $lines): ?int
    {
        return $lines->filter->is('*<link rel="stylesheet" href="*">')->keys()->last();
    }

    public function render(string $content): string
    {
        return Str::sprintf('%s<style>%s</style>', Str::tab(), $content);
    }
}
