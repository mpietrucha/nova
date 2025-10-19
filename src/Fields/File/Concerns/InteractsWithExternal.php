<?php

namespace Mpietrucha\Nova\Fields\File\Concerns;

use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\File;
use Mpietrucha\Nova\Fields\File\Proxy;

trait InteractsWithExternal
{
    use InteractsWithRequest;

    public function external(): File|Proxy
    {
        $this->preview($callback = fn () => $this->value);
        $this->thumbnail($callback);

        if (static::request()->isPresentationRequest()) {
            return $this;
        }

        return Proxy::replicate($this);
    }
}
