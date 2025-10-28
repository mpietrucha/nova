<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class RepeatableFieldsException extends RuntimeException
{
    public function initilize(): void
    {
        'Repeatable media must be hydrated before initialization' |> $this->message(...);
    }
}
