<?php

namespace Mpietrucha\Nova\Fields\Clone\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Clone\Properties;
use Mpietrucha\Utility\Arr;

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
        /** @var list<string> $properties */
        $properties = Arr::prepend(static::cloneable(), 'name');

        return static::make(...) |> Properties::get($source, $properties)->values()->pipeSpread(...);
    }

    /**
     * @return list<string>
     */
    protected static function cloneable(): array
    {
        return [static::$cloneable, static::$clone] |> Arr::flatten(...);
    }
}
