<?php

namespace Mpietrucha\Nova\Fields\Clone\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Clone\Defaults;
use Mpietrucha\Nova\Fields\Clone\Properties;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Instance\Property;
use Mpietrucha\Utility\Normalizer;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\Clone\Contracts\CloneableInterface
 */
trait Cloneable
{
    public static function clone(Field $source): static
    {
        $properties = static::cloneable();

        return static::make(...) |> Properties::get($source, $properties)->values()->pipeSpread(...);
    }

    /**
     * @return list<string>
     */
    protected static function cloneable(): array
    {
        $cloneable = match (true) {
            Property::exists(static::class, 'cloneable') => static::$cloneable,
            default => []
        } |> Normalizer::array(...);

        $clone = match (true) {
            Property::exists(static::class, 'clone') => static::$clone,
            default => []
        } |> Normalizer::array(...);

        return [Defaults::get(), $cloneable, $clone] |> Arr::flatten(...);
    }
}
