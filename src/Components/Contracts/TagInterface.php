<?php

namespace Mpietrucha\Nova\Components\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface TagInterface
{
    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Stringable>  $lines
     */
    public function index(EnumerableInterface $lines): ?int;

    public function render(string $content): string;
}
