<?php

namespace Mpietrucha\Nova\Fields\Field;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

abstract class Validation implements InteractsWithRequestInterface
{
    use InteractsWithRequest;

    public const REQUIRED = 'required';

    public static function inherit(Field $source, Field $destination, ?string $rule = null): void
    {
        $rule ??= static::REQUIRED;

        if (static::rules($source)->doesntContain($rule)) {
            return;
        }

        static::rules($destination)->prepend($rule) |> $destination->rules(...);
    }

    public static function required(Field $field): bool
    {
        return static::REQUIRED |> static::rules($field)->contains(...);
    }

    final public static function options(Field $field): bool
    {
        return static::required($field) |> Normalizer::not(...);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string|\Illuminate\Contracts\Validation\ValidationRule>
     */
    protected static function rules(Field $field): Collection
    {
        $evaluation = $field->rules |> Value::for(...);

        return static::request() |> $evaluation->get(...) |> Collection::create(...);
    }
}
