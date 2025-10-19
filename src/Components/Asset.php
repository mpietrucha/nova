<?php

namespace Mpietrucha\Nova\Components;

use Laravel\Nova\Concerns\InteractsWithAssets;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

class Asset
{
    use InteractsWithAssets;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Laravel\Nova\Asset>
     */
    public static function flush(): EnumerableInterface
    {
        $styles = static::$styles;
        $scripts = static::$scripts;

        static::$styles = [];
        static::$scripts = [];

        return Collection::from($styles, $scripts)->flatten();
    }
}
