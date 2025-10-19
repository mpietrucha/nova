<?php

namespace Mpietrucha\Nova\Fields\Clone;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Clone\Exception\FieldPropertyException;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Type;

class Properties implements CreatableInterface
{
    use Creatable;

    /**
     * @param  list<string>  $properties
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<array-key, mixed>
     */
    public static function get(Field $source, array $properties): EnumerableInterface
    {
        $cloner = Cloner::create($source);

        return $cloner->get(...) |> static::build($cloner, $properties)->map(...);
    }

    /**
     * @param  list<string>  $properties
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected static function build(Cloner $cloner, array $properties): EnumerableInterface
    {
        $properties = Collection::create($properties);

        $property = $cloner->unsupported(...) |> $properties->first(...);

        if (Type::null($property)) {
            return $properties;
        }

        FieldPropertyException::for($cloner->name(), $property)->throw();
    }
}
