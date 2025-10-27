<?php

namespace Mpietrucha\Nova\Fields\Media\Concerns;

use Mpietrucha\Nova\Fields\Media\External;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\File\Contracts\InteractsWithExternalInterface
 */
trait InteractsWithExternal
{
    public function external(): External|static
    {
        External::preview(...) |> $this->preview(...);
        External::thumbnail(...) |> $this->thumbnail(...);

        if (External::incompatible()) {
            return $this;
        }

        return External::replicate($this);
    }
}
