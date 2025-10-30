<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Media\Adapter;
use Mpietrucha\Nova\Fields\Media\Collection;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;

abstract class Media
{
    public static function audio(?string $name = null): Audio
    {
        $name ??= __('mpietrucha-nova::media.fields.audio');

        return Audio::make($name) |> static::configure(...);
    }

    public static function avatar(?string $name = null): Avatar
    {
        $name ??= __('mpietrucha-nova::media.fields.avatar');

        return Avatar::make($name) |> static::configure(...);
    }

    public static function image(?string $name = null): Image
    {
        $name ??= __('mpietrucha-nova::media.fields.image');

        return Image::make($name) |> static::configure(...);
    }

    public static function file(?string $name = null): File
    {
        $name ??= __('mpietrucha-nova::media.fields.file');

        return File::make($name) |> static::configure(...);
    }

    /**
     * @param  list<\Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface>  $fields
     */
    public static function collection(string $name, array $fields): Collection
    {
        return Collection::make($name, $fields); /** @phpstan-ignore argument.type */
    }

    protected static function configure(InteractsWithMediaInterface $field): InteractsWithMediaInterface
    {
        Adapter::attach($field); /** @phpstan-ignore argument.type */

        return $field;
    }
}
