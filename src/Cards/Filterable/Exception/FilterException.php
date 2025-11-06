<?php

namespace Mpietrucha\Nova\Cards\Filterable\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class FilterException extends RuntimeException
{
    public function configure(string $method): string
    {
        return 'Filter `%s` does not exists';
    }
}
