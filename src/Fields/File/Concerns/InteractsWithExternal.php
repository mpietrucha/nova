<?php

namespace Mpietrucha\Nova\Fields\File\Concerns;

use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\File\External;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\File\Contracts\InteractsWithExternalInterface
 */
trait InteractsWithExternal
{
    use InteractsWithRequest;

    public function external(): External|static
    {
        $this->preview($callback = fn () => $this->value);
        $this->thumbnail($callback);

        if (static::request()->isPresentationRequest()) {
            return $this;
        }

        return External::replicate($this);
    }
}
