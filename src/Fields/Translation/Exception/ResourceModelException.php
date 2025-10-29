<?php

namespace Mpietrucha\Nova\Fields\Translation\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;
use Spatie\Translatable\HasTranslations;

class ResourceModelException extends InvalidArgumentException
{
    public function initilize(): void
    {
        $this->message('Model must use %s trait', HasTranslations::class);
    }
}
