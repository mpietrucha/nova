<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Fields\File;
use Mpietrucha\Nova\Fields\Media\Validation\Media;
use Mpietrucha\Nova\Fields\Media\Validation\Repeatable;

abstract class Validation extends \Mpietrucha\Nova\Fields\Field\Validation
{
    public static function media(File $field): void
    {
        $rules = static::rules($field);

        if (Repeatable::get() |> $rules->contains(...)) {
            return;
        }

        $rule = Media::get($field);

        $rules->prepend($rule)->all() |> $field->rules(...);
    }

    public static function repeatable(File $field): void
    {
        $rule = Repeatable::get();

        static::rules($field)->prepend($rule)->all() |> $field->rules(...);
    }
}
