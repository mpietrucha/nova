<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class RepeatableHydrationException extends RuntimeException
{
    public function initilize(): void
    {
        'Repeatable must be hydrated before initialization' |> $this->message(...);
    }
}
