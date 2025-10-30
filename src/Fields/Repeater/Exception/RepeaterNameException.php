<?php

namespace Mpietrucha\Nova\Fields\Repeater\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class RepeaterNameException extends RuntimeException
{
    public function configure(string $name): string
    {
        return 'Repeater name `%s` is forbidden';
    }
}
