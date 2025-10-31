<?php

namespace Mpietrucha\Nova\Fields\Media;

use Mpietrucha\Nova\Fields\Media\Exception\MediaModelException;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

abstract class Attribute implements CompatibleInterface
{
    use Compatible;

    public static function model(mixed $model): Media
    {
        static::incompatible($model) && MediaModelException::create()->throw();

        return $model;
    }

    public static function name(mixed $model): string
    {
        return static::model($model)->getPathRelativeToRoot();
    }

    public static function file(mixed $model): string
    {
        return static::model($model)->getPath();
    }

    public static function url(mixed $model): string
    {
        return static::model($model)->getUrl();
    }

    protected static function compatibility(mixed $model): bool
    {
        return $model instanceof Media;
    }
}
