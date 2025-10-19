<?php

namespace Mpietrucha\Nova\Fields\File\Concerns;

use Mpietrucha\Nova\Fields\Audio;
use Mpietrucha\Nova\Fields\Avatar;
use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\File;
use Mpietrucha\Nova\Fields\File\Proxy;
use Mpietrucha\Nova\Fields\Image;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\File\Contracts\InteractsWithExternalInterface
 */
trait InteractsWithExternal
{
    use InteractsWithRequest;

    public function external(): Audio|Avatar|File|Image|Proxy
    {
        $this->preview($callback = fn () => $this->value);
        $this->thumbnail($callback);

        if (static::request()->isPresentationRequest()) {
            return $this;
        }

        return Proxy::replicate($this);
    }
}
