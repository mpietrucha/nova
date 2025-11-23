<?php

namespace Mpietrucha\Nova\Fields;

use Laravel\Nova\Fields\File as Field;
use Mpietrucha\Laravel\Package\Translations\Concerns\InteractsWithTranslations;
use Mpietrucha\Nova\Fields\Media\Collection;
use Mpietrucha\Nova\Fields\Media\Initializer;

abstract class Media
{
    use InteractsWithTranslations;

    public static function audio(?string $name = null): Audio
    {
        $name ??= static::__('media.audio');

        return Audio::make($name) |> static::initialize(...);
    }

    public static function avatar(?string $name = null): Avatar
    {
        $name ??= static::__('media.avatar');

        return Avatar::make($name) |> static::initialize(...);
    }

    public static function image(?string $name = null): Image
    {
        $name ??= static::__('media.image');

        return Image::make($name) |> static::initialize(...);
    }

    public static function file(?string $name = null): File
    {
        $name = $name ?? static::__('media.file');

        return File::make($name) |> static::initialize(...);
    }

    /**
     * @param  list<\Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface>  $fields
     */
    public static function collection(string $name, array $fields): Collection
    {
        return Collection::make($name, $fields);
    }

    protected static function initialize(Field $field): Field
    {
        return Initializer::initialize($field);
    }
}
