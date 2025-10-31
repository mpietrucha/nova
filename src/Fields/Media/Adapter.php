<?php

namespace Mpietrucha\Nova\Fields\Media;

use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Media\Adapter\Builder;
use Mpietrucha\Nova\Fields\Media\Exception\ResourceModelException;
use Mpietrucha\Nova\Fields\Repeater\Transformer;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Normalizer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\StreamedResponse;

abstract class Adapter implements CompatibleInterface, InteractsWithRequestInterface
{
    use Compatible, InteractsWithRequest;

    public static function model(mixed $model): HasMedia
    {
        static::incompatible($model) && ResourceModelException::create()->throw();

        return $model;
    }

    public static function clear(mixed $model, string $attribute): void
    {
        static::model($model)->clearMediaCollection($attribute);
    }

    public static function exists(mixed $model, string $attribute): bool
    {
        return static::model($model)->hasMedia($attribute);
    }

    final public static function unexists(mixed $model, string $attribute): bool
    {
        return static::exists($model, $attribute) |> Normalizer::not(...);
    }

    public static function builder(mixed $model): Builder
    {
        return static::model($model) |> Builder::create(...);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media>
     */
    public static function get(mixed $model, string $attribute): Collection
    {
        return static::model($model)->getMedia($attribute) |> Collection::bind(...);
    }

    public static function first(mixed $model, string $attribute): Media
    {
        $collection = static::get($model, $attribute);

        return $collection->first() |> Attribute::model(...);
    }

    public static function download(mixed $model, string $attribute): ?StreamedResponse
    {
        if (static::unexists($model, $attribute)) {
            return null;
        }

        return static::request() |> static::first($model, $attribute)->toResponse(...);
    }

    protected static function compatibility(mixed $model): bool
    {
        return Transformer::compatible($model) && $model instanceof HasMedia;
    }
}
