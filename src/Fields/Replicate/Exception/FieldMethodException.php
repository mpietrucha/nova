<?php

namespace Mpietrucha\Nova\Fields\Replicate\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class FieldMethodException extends RuntimeException
{
    public function configure(string $field, string $property): string
    {
        return 'Field %s doesnt have method `%s`';
    }
}
