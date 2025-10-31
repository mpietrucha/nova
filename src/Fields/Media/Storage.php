<?php

namespace Mpietrucha\Nova\Fields\Media;

use Illuminate\Support\Facades\Storage as Adapter;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

abstract class Storage implements CompatibleInterface
{
    use Compatible;

    public static function disk(?string $disk = null): string
    {
        return Normalizer::string($disk);
    }

    public static function preview(mixed $value, ?string $disk = null): ?string
    {
        if (static::incompatible($value)) {
            return null;
        }

        return Adapter::disk($disk)->url($value);
    }

    public static function thumbnail(mixed $value, ?string $disk = null): ?string
    {
        if (static::incompatible($value)) {
            return null;
        }

        return Adapter::disk($disk)->url($value);
    }

    protected static function compatibility(mixed $value): bool
    {
        return Type::string($value);
    }
}
