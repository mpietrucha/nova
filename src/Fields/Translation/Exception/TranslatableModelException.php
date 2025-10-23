<?php

namespace Mpietrucha\Nova\Fields\Translation\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;
use Spatie\Translatable\HasTranslations;

class TranslatableModelException extends InvalidArgumentException
{
    public function initilize(): void
    {
        $this->message('Translatable model must use %s trait', HasTranslations::class);
    }
}
