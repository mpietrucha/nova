<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Utility\Throwable\RuntimeException;

class CollectionFieldException extends RuntimeException
{
    public function initialize(): void
    {
        $this->message('Media collection field must implement %s interface', InteractsWithMediaInterface::class);
    }
}
