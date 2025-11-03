<?php

namespace Mpietrucha\Nova\Fields\Translation;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;

abstract class Validation extends \Mpietrucha\Nova\Fields\Field\Validation
{
    /**
     * @param  list<string|\Illuminate\Contracts\Validation\ValidationRule>|null  $rules
     */
    public static function apply(Field $field, ?array $rules = null): void
    {
        $field->required();

        [static::REQUIRED, Normalizer::array($rules)] |> Arr::flatten(...) |> $field->rules(...);
    }
}
