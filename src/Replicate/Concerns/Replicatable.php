<?php

namespace Mpietrucha\Nova\Replicate\Concerns;

use Laravel\Nova\Fields\Field;

trait Replicatable
{
    /**
     * @var array<string, string>
     */
    protected static array $replicate = [];

    /**
     * @var array<string, string>
     */
    protected static array $replicatable = [];

    public static function replicate(Field $source): static
    {
        $properties = Property::get($source, static::replicatable() |> Arr::filp(...));

        $destination = static::clone($source);

        Method::call($destination, $properties->flip());

        return $destination;
    }

    protected static function replicatable(): array
    {
        return [static::$replicatable, static::$replicate] |> Arr::flatten(...);
    }
}
