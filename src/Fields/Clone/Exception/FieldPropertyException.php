<?php

namespace Mpietrucha\Nova\Fields\Clone\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class FieldPropertyException extends RuntimeException
{
    public function configure(string $field, string $property): string
    {
        return 'Field %s doesnt have property `%s`';
    }
}
