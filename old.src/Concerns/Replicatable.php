<?php

namespace Mpietrucha\Nova\Concerns;

use Mpietrucha\Nova\Concerns\Cloneable;
use Laravel\Nova\Fields\Field;

trait Replicatable
{
    use Cloneable;

    public static function repliacate(Field $source): static
    {
        $field = static::clone($source);

        // $properties = static::replicatable($field)->each()
    }

    protected static function replicatable(Field $field): EnumerableInterface
    {
        $properties = static::$replicatable |> Collection::create(...);


    }
}
