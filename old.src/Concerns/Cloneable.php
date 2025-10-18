<?php

namespace App\Nova\Concerns;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Instance\Property;

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

    public static function clone(Field $field): static
    {
        $properties = static::cloneable($field)->map(fn (string $property) => $field->$property);

        return static::make($field->name, ...$properties);
    }

    public static function cloneable(Field $field): EnumerableInterface
    {
        $properties = static::$cloneable |> Collection::create(...);

        return $properties->filter(fn (string $property) => Property::exists($field, $property));
    }
}
