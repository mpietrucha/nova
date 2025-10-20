<?php

namespace Mpietrucha\Nova\Fields\External\Concerns;

use Mpietrucha\Nova\Fields\Concerns\InteractsWithRequest;
use Mpietrucha\Nova\Fields\External\File;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\File\Contracts\InteractsWithExternalInterface
 */
trait InteractsWithExternal
{
    use InteractsWithRequest;

    public function external(): File|static
    {
        File::preview($this) |> $this->preview(...);
        File::thumbnail($this) |> $this->thumbnail(...);

        if (File::incompatible()) {
            return $this;
        }

        return File::replicate($this);
    }
}
