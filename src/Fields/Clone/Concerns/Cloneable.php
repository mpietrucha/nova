<?php

namespace Mpietrucha\Nova\Fields\Clone\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Clone\Properties;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Instance\Property;
use Mpietrucha\Utility\Normalizer;

trait Cloneable
{
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
        $cloneable = match (true) { /** @phpstan-ignore-next-line staticProperty.notFound */
            Property::exists(static::class, 'cloneable') => static::$cloneable,
            default => []
        } |> Normalizer::array(...);

        $clone = match (true) { /** @phpstan-ignore-next-line staticProperty.notFound */
            Property::exists(static::class, 'clone') => static::$clone,
            default => []
        } |> Normalizer::array(...);

        return [$cloneable, $clone] |> Arr::flatten(...);
    }
}
