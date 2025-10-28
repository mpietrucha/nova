<?php

namespace Mpietrucha\Nova\Fields\Repeatable;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

abstract class Encoder implements CreatableInterface
{
    use Creatable;

    /**
     * @param  RepeatableTransformerInputFrame  $frame
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>
     */
    protected static function fields(array $frame): EnumerableInterface
    {
        return Arr::get($frame, 'fields') |> Collection::create(...);
    }
}
