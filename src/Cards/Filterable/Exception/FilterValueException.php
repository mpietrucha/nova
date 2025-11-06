<?php

namespace Mpietrucha\Nova\Cards\Filterable\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class FilterValueException extends InvalidArgumentException
{
    public function initialize(): void
    {
        'Filter value is required' |> $this->message(...);
    }
}
