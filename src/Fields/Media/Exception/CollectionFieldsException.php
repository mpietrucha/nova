<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class CollectionFieldsException extends RuntimeException
{
    public function initialize(): void
    {
        'Media collection must contain only one field' |> $this->message(...);
    }
}
