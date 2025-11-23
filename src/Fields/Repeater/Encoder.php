<?php

namespace Mpietrucha\Nova\Fields\Repeater;

use Mpietrucha\Nova\Fields\Repeater\Enums\Frame;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @phpstan-import-type RepeaterInput from \Mpietrucha\Nova\Fields\Repeater\Contracts\TransformerInterface
 * @phpstan-import-type RepeaterOutput from \Mpietrucha\Nova\Fields\Repeater\Contracts\TransformerInterface
 *
 * @phpstan-type EncoderFieldsCollection  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, mixed>
 */
abstract class Encoder implements CreatableInterface
{
    use Creatable;

    /**
     * @param  RepeaterInput  $frame
     * @return EncoderFieldsCollection
     */
    protected static function fields(array $frame): EnumerableInterface
    {
        $fields = Frame::FIELDS->value;

        return Arr::get($frame, $fields) |> Collection::create(...);
    }
}
