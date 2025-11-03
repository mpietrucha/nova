<?php

namespace Mpietrucha\Nova\Enum\Concerns;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Str;

trait InteractsWithNova
{
    public static function options(): string
    {
        return static::class;
    }

    public static function default(): static
    {
        return static::cases() |> Arr::first(...);
    }

    public function name(): string
    {
        $value = $this->value |> Str::of(...);

        if ($value->upper()->exactly($value)) {
            return $value;
        }

        return $value->headline()->lower()->ucfirst();
    }
}
