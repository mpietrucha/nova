<?php

namespace Mpietrucha\Nova\Cards\Filterable\Filter;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Traits\Macroable;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Instance\Method;
use Mpietrucha\Utility\Str;

abstract class Handler implements CompatibleInterface
{
    use Compatible, Macroable;

    public static function get(string $handler): ?callable
    {
        return static::compatible($handler) ? static::$handler(...) : null;
    }

    public static function contains(Builder $query, string $property, mixed $value): void
    {
        $query->whereLike($property, "%$value%");
    }

    public static function doesntContain(Builder $query, string $property, mixed $value): void
    {
        $query->whereNotLike($property, "%$value%");
    }

    public static function startsWith(Builder $query, string $property, mixed $value): void
    {
        $query->whereLike($property, "$value%");
    }

    public static function endsWith(Builder $query, string $property, mixed $value): void
    {
        $query->whereLike($property, "%$value");
    }

    public static function empty(Builder $query, string $property, mixed $value): void
    {
        $query->whereNull($property)->orWhere($property, Str::none());
    }

    public static function notEmpty(Builder $query, string $property, mixed $value): void
    {
        $query->whereNotNull($property)->whereNot($property, Str::none());
    }

    protected static function compatibility(string $handler): bool
    {
        if (static::hasMacro($handler)) {
            return true;
        }

        return Method::exists(static::class, $handler);
    }
}
