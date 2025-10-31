<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class AdapterBuilderException extends RuntimeException
{
    public function initialize(): void
    {
        $this->message('No file was added to Builder instance');
    }
}
