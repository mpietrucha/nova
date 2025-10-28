<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;
use Spatie\MediaLibrary\HasMedia;

class TransformerModelException extends InvalidArgumentException
{
    public function initilize(): void
    {
        $this->message('Transformer model must implement %s interface', HasMedia::class);
    }
}
