<?php

namespace Mpietrucha\Nova\Clone\Exception;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Utility\Throwable\RuntimeException;

class FieldPropertyException extends RuntimeException
{
    public function configure(Field $field, string $property): string
    {

    }
}
