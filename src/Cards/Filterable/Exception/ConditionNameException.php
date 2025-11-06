<?php

namespace Mpietrucha\Nova\Cards\Filterable\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class ConditionNameException extends InvalidArgumentException
{
    public function initialize(): void
    {
        'Condition name is required' |> $this->message(...);
    }
}
