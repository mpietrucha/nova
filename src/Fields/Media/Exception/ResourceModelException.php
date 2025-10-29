<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;
use Spatie\MediaLibrary\HasMedia;

class ResourceModelException extends InvalidArgumentException
{
    public function initilize(): void
    {
        $this->message('Resource model must implement %s interface', HasMedia::class);
    }
}
