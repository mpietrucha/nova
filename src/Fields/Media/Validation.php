<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\File;
use Mpietrucha\Nova\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\Media\Validation\Rule;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

abstract class Validation implements InteractsWithRequestInterface
{
    use InteractsWithRequest;

    public static function inherit(File $source, Field $destination): void
    {
        if (static::optional($source)) {
            return;
        }

        $rule = Rule::REQUIRED;

        static::rules($destination)->prepend($rule)->all() |> $destination->rules(...);
    }

    public static function assign(File $field): void
    {
        $rules = static::rules($field);

        if (Rule::repeatable() |> $rules->contains(...)) {
            return;
        }

        $rule = Rule::get($field);

        $rules->prepend($rule)->all() |> $field->rules(...);
    }

    public static function repeatable(File $field): void
    {
        $rule = Rule::repeatable();

        static::rules($field)->prepend($rule)->all() |> $field->rules(...);
    }

    public static function required(File $field): bool
    {
        return Rule::REQUIRED |> static::rules($field)->contains(...);
    }

    final public static function optional(File $field): bool
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
