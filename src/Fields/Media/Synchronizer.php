<?php

namespace Mpietrucha\Nova\Fields\Media;

use Mpietrucha\Nova\Fields\Media\Synchronizer\Bucket;
use Mpietrucha\Nova\Fields\Media\Synchronizer\Input;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;
use Spatie\MediaLibrary\HasMedia;

abstract class Synchronizer
{
    /**
     * @param  RepeatableTransformerOutput  $output
     */
    public static function synchronize(HasMedia $model, string $attribute, array $output, ?string $disk = null): void
    {
        $bucket = $model->getMedia($attribute) |> Bucket::build(...);

        $model->clearMediaCollection($attribute);

        $disk = Normalizer::string($disk);

        static::get($bucket, $model, $output)->each->toMediaCollection($attribute, $disk);

        Bucket::flush();
    }

    /**
     * @param  RepeatableTransformerOutput  $output
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Spatie\MediaLibrary\MediaCollections\FileAdder>
     */
    public static function get(Bucket $bucket, HasMedia $model, array $output): EnumerableInterface
    {
        return Collection::create($output)->pipeThrough([
            fn (EnumerableInterface $media) => $media->whereInstanceOf(Input::class),
            fn (EnumerableInterface $media) => $media->map->get($bucket),
            fn (EnumerableInterface $media) => $model->addMedia(...) |> $media->filter()->map(...),
        ]);
    }
}
