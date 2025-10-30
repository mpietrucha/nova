<?php

namespace Mpietrucha\Nova\Fields\Media\Validation;

use Mpietrucha\Nova\Fields\Media\Index;
use Mpietrucha\Utility\Str;

abstract class Repeatable
{
    public static function get(): string
    {
        $index = Index::property();

        return Str::sprintf(static::template(), $index);
    }

    protected static function template(): string
    {
        return 'exclude_unless:{{repeatable}}.%s,null';
    }
}
