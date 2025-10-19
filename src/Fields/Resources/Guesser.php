<?php

namespace Mpietrucha\Nova\Fields\Resources;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;

abstract class Guesser
{
    /**
     * @template TResource of \Laravel\Nova\Resource<\Illuminate\Database\Eloquent\Model>
     *
     * @param  class-string<TResource>|null  $resource
     * @return class-string<TResource>|null
     */
    public static function guess(string $name, ?string $resource = null): ?string
    {
        if (Type::string($resource)) {
            return $resource;
        }

        $resource = Instance\Path::join(
            app()->getNamespace(),
            'Nova',
            'Resources',
            Str::of($name)->singular()->studly()
        );

        /** @var class-string<TResource>|null */
        return Instance::exists($resource) ? $resource : null;
    }
}
