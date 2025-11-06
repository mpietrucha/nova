<?php

namespace Mpietrucha\Nova\Cards\Filterable\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class FilterNameException extends InvalidArgumentException
{
    public function initialize(): void
    {
        'Filter name is required' |> $this->message(...);
    }
}
