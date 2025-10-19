<?php

namespace Mpietrucha\Nova\Fields\Replicate;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Replicate\Exception\FieldMethodException;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Type;

class Methods
{
    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>|array<string, string>  $methods
     */
    public static function call(Field $source, array|EnumerableInterface $methods): void
    {
        $replicator = Replicator::create($source);

        $replicator->call(...) |> static::build($replicator, $methods)->each(...);
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>|array<string, string>  $methods
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>
     */
    protected static function build(Replicator $replicator, array|EnumerableInterface $methods): EnumerableInterface
    {
        $methods = Collection::bind($methods);

        $method = $replicator->unsupported(...) |> $methods->keys()->first(...);

        if (Type::null($method)) {
            return $methods;
        }

        FieldMethodException::for($replicator->name(), $method)->throw();
    }
}
