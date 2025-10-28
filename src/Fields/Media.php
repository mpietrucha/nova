<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Media\Collection;

abstract class Media
{
    public static function audio(string $name): Audio
    {
        return Audio::make($name);
    }

    public static function avatar(?string $name = null): Avatar
    {
        return Avatar::make($name);
    }

    public static function image(string $name): Image
    {
        return Image::make($name);
    }

    public static function file(string $name): File
    {
        return File::make($name);
    }

    /**
     * @param  list<\Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface>  $fields
     */
    public static function collection(string $name, array $fields): Collection
    {
        return Collection::make($name, $fields);
    }
}
