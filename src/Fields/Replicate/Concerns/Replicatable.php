<?php

namespace Mpietrucha\Nova\Fields\Replicate\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;
use Mpietrucha\Nova\Fields\Clone\Properties;
use Mpietrucha\Nova\Fields\Replicate\Methods;
use Mpietrucha\Utility\Arr;

trait Replicatable
{
    use Cloneable;

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
        return [static::$replicatable, static::$replicate] |> Arr::flatten(...);
    }
}
