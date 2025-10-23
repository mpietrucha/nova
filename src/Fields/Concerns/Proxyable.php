<?php

namespace Mpietrucha\Nova\Fields\Concerns;

/**
 * phpstan-require-extends \Laravel\Nova\Fields\Field
 */
trait Proxyable
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
