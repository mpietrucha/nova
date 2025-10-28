<?php

namespace Mpietrucha\Nova\Fields\Repeatable\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class TransformerModelException extends InvalidArgumentException
{
    public function initilize(): void
    {
        'Transformer model must be an Eloquent Model' |> $this->message(...);
    }
}
