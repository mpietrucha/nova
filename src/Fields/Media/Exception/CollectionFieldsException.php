<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class CollectionFieldsException extends InvalidArgumentException
{
    public function initialize(): void
    {
        'Collection must contain only one field' |> $this->message(...);
    }
}
