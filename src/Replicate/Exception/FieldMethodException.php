<?php

namespace Mpietrucha\Nova\Replicate\Exception;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Utility\Throwable\RuntimeException;

class FieldMethodException extends RuntimeException
{
    public function configure(Field $field, string $method): string
    {

    }
}
