<?php

namespace Mpietrucha\Nova\Fields\Translation\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class RepeatableSelectException extends InvalidArgumentException
{
    public function initialize(): void
    {
        'Repeatable field requires an associated Select field to run' |> $this->message(...);
    }
}
