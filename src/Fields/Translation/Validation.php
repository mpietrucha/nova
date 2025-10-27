<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;

abstract class Validation
{
    /**
     * @param  list<string|\Illuminate\Contracts\Validation\ValidationRule>|null  $rules
     */
    public static function apply(Field $field, ?array $rules = null): void
    {
        $field->required();

        static::rules($rules) |> $field->rules(...);
    }

    /**
     * @param  list<string|\Illuminate\Contracts\Validation\ValidationRule>|null  $rules
     * @return list<string>
     */
    public static function rules(?array $rules = null): array
    {
        return ['required', Normalizer::array($rules)] |> Arr::flatten(...);
    }
}
