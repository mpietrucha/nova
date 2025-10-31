<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class InitializerException extends InvalidArgumentException
{
    public function configure(string $initializer): string
    {
        return '`%s` is not valid initializer';
    }
}
