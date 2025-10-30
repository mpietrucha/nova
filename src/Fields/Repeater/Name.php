<?php

namespace Mpietrucha\Nova\Fields\Repeater;

use Laravel\Nova\Fields\Repeater;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;

abstract class Name
{
    /**
     * @var list<string>
     */
    protected static array $attributes = [
        'files',
    ];

    /**
     * @return list<string>
     */
    public static function attributes(): array
    {
        return static::$attributes;
    }

    public static function forbidden(Repeater $repeater): bool
    {
        $attribute = $repeater->attribute;

        return Arr::contains(static::attributes(), $attribute);
    }

    final public static function allowed(Repeater $repeater): bool
    {
        return static::forbidden($repeater) |> Normalizer::not(...);
    }
}
