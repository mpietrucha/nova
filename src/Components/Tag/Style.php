<?php

namespace Mpietrucha\Nova\Components\Tag;

use Laravel\Nova\Style as Asset;
use Mpietrucha\Nova\Components\Tag;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Str;

class Style extends Tag
{
    public function __construct(Asset $asset)
    {
        parent::__construct($asset);
    }

    public function index(EnumerableInterface $lines): ?int
    {
        return $lines->filter->is('*<link rel="stylesheet" href="*">')->keys()->last();
    }

    public function render(string $content): string
    {
        return Str::sprintf('%s<style>%s</style>', Str::tab(), $content);
    }
}
