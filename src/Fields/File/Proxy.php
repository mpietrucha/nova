<?php

namespace Mpietrucha\Nova\Fields\File;

use Mpietrucha\Nova\Fields\Text;

class Proxy extends Text
{
    /**
     * @param  string  $method
     * @param  array<array-key, mixed>  $arguments
     */
    public function __call($method, $arguments): static
    {
        if (static::hasMacro($method)) {
            return parent::__call($method, $arguments);
        }

        return $this;
    }
}
