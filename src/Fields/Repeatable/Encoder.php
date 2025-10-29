<?php

namespace Mpietrucha\Nova\Fields\Repeatable;

use Mpietrucha\Nova\Fields\Repeatable\Enums\Frame;
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
     * @return RepeatableTransformerInputFrameFieldsCollection
     */
    protected static function fields(array $frame): EnumerableInterface
    {
        $fields = Frame::FIELDS->value;

        return Arr::get($frame, $fields) |> Collection::create(...);
    }
}
