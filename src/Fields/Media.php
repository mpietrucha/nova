<?php

namespace Mpietrucha\Nova\Fields;

use Laravel\Nova\Fields\File as Field;
use Mpietrucha\Nova\Fields\Media\Collection;
use Mpietrucha\Nova\Fields\Media\Initializer;

abstract class Media
{
    public static function audio(?string $name = null): Audio
    {
        $name ??= __('mpietrucha-nova::media.fields.audio');

        return Audio::make($name) |> static::initialize(...);
    }

    public static function avatar(?string $name = null): Avatar
    {
        $name ??= __('mpietrucha-nova::media.fields.avatar');

        return Avatar::make($name) |> static::initialize(...);
    }

    public static function image(?string $name = null): Image
    {
        $name ??= __('mpietrucha-nova::media.fields.image');

        return Image::make($name) |> static::initialize(...);
    }

    public static function file(?string $name = null): File
    {
        $name ??= __('mpietrucha-nova::media.fields.file');

        return File::make($name) |> static::initialize(...);
    }

    /**
     * @param  list<\Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface>  $fields
     */
    public static function collection(string $name, array $fields): Collection
    {
        return Collection::make($name, $fields); /** @phpstan-ignore argument.type */
    }

    protected static function initialize(Field $field): Field
    {
        return Initializer::initialize($field);
    }
}
