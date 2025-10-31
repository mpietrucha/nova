<?php

namespace Mpietrucha\Nova\Fields\Media\Synchronizer;

use Mpietrucha\Nova\Fields\Media\Attribute;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Filesystem\Temporary;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

/**
 * @extends \Mpietrucha\Utility\Collection<int, string>
 *
 * @phpstan-ignore-next-line class.missingImplements
 */
class Bucket extends Collection implements UtilizableInterface
{
    use Utilizable\Strings;

    public static function flush(): void
    {
        static::directory() |> Filesystem::cleanDirectory(...);
    }

    /**
     * @param  \Mpietrucha\Utility\Collection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media>  $collection
     */
    public static function build(Collection $collection): static
    {
        static::flush();

        return static::store(...) |> $collection->map(...) |> static::create(...);
    }

    protected static function store(mixed $model): string
    {
        $destination = static::destination($model);

        $file = Attribute::file($model);

        Filesystem::copy($file, $destination);

        return $destination;
    }

    protected static function destination(mixed $model): string
    {
        $name = Attribute::name($model);

        return Path::build($name, static::directory());
    }

    protected static function directory(): string
    {
        return static::utilize();
    }

    protected static function hydrate(): string
    {
        return Temporary::directory('bucket');
    }
}
