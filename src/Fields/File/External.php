<?php

namespace Mpietrucha\Nova\Fields\File;

use Mpietrucha\Nova\Fields\Text;

/**
 * @mixin \Mpietrucha\Nova\Fields\Audio
 * @mixin \Mpietrucha\Nova\Fields\Avatar
 */
class External extends Text
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
