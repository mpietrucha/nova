<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class MediaException extends RuntimeException
{
    public function initialize(): void
    {
        'Model does not have any media attached' |> $this->message(...);
    }
}
