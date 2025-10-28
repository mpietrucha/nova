<?php

namespace Mpietrucha\Nova\Fields\Translation\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;
use Spatie\Translatable\HasTranslations;

class TransformerModelException extends InvalidArgumentException
{
    public function initilize(): void
    {
        $this->message('Transformer model must be an Eloquent model and use %s trait', HasTranslations::class);
    }
}
