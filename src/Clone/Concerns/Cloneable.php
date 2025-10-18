<?php

namespace Mpietrucha\Nova\Clone\Concerns;

use Mpietrucha\Nova\Clone\Properties;

trait Cloneable
{
    /**
     * @var array<int, string>
     */
    protected static array $clone = [];

    /**
     * @var array<int, string>
     */
    protected static array $cloneable = [];

    public static function clone(Field $source): static
    {
        $properties = Arr::prepend(static::cloneable(), 'name');

        return static::make(...) |> Properties::get($source, $properties)->values()->pipeSpread(...);
    }

    protected static function cloneable(): array
    {
        return [static::$cloneable, static::$clone] |> Arr::flatten(...);
    }
}
