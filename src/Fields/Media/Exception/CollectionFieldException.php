<?php

namespace Mpietrucha\Nova\Fields\Media\Exception;

use Laravel\Nova\Fields\File;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;
use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class CollectionFieldException extends InvalidArgumentException
{
    public function initialize(): void
    {
        [$instance, $interface] = [
            File::class, InteractsWithMediaInterface::class,
        ];

        $this->message('Collection field must be instance of %s and implement %s interface', $instance, $interface);
    }
}
