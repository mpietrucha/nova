<?php

namespace Mpietrucha\Nova\Fields\Repeater\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class ResourceModelException extends InvalidArgumentException
{
    public function initilize(): void
    {
        'Resource model must be an Eloquent Model' |> $this->message(...);
    }
}
