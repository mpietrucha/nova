<?php

namespace Mpietrucha\Nova\Fields\Replicate\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;
use Mpietrucha\Nova\Fields\Clone\Properties;
use Mpietrucha\Nova\Fields\Replicate\Methods;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Instance\Property;
use Mpietrucha\Utility\Normalizer;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\Replicate\Contracts\ReplicatableInterface
 */
trait Replicatable
{
    use Cloneable;

    public static function replicate(Field $source): static
    {
        $methods = Properties::get($source, static::replicatable() |> Arr::flip(...));

        $destination = static::clone($source);

        Methods::call($destination, $methods);

        return $destination;
    }

    /**
     * @return list<string>
     */
    protected static function replicatable(): array
    {
        $replicatable = match (true) {
            Property::exists(static::class, 'replicatable') => static::$replicatable,
            default => []
        } |> Normalizer::array(...);

        $replicate = match (true) {
            Property::exists(static::class, 'replicate') => static::$replicate,
            default => []
        } |> Normalizer::array(...);

        return [$replicatable, $replicate] |> Arr::collapse(...);
    }
}
