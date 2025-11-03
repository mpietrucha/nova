<?php

namespace Mpietrucha\Nova\Fields\Translation\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;
use Spatie\Translatable\HasTranslations;

class ResourceModelException extends InvalidArgumentException
{
    public function initialize(): void
    {
        $this->message('Resource model must use %s trait', HasTranslations::class);
    }
}
