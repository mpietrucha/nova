<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaModelException extends InvalidArgumentException
{
    public function initialize(): void
    {
        $this->message('Media model must be instance of %s', Media::class);
    }
}
