<?php

namespace Mpietrucha\Nova\Fields\Media\Synchronizer;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Filesystem\Temporary;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
     * @param  \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<string, \Spatie\MediaLibrary\MediaCollections\Models\Media>  $collection
     */
    public static function build(MediaCollection $collection): static
    {
        static::flush();

        return static::store(...) |> $collection->map(...) |> static::create(...);
    }

    protected static function store(Media $media): string
    {
        $destination = static::destination($media);

        $file = $media->getPath();

        Filesystem::copy($file, $destination);

        return $destination;
    }

    protected static function destination(Media $model): string
    {
        $name = $model->file_name;

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
