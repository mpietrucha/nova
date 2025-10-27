<?php

namespace Mpietrucha\Nova\Fields\Delegate\Concerns;

use Mpietrucha\Nova\Fields\Delegate\Delegator;

/**
 * @mixin \Laravel\Nova\Fields\Field
 *
 * @phpstan-require-extends \Laravel\Nova\Fields\Field
 */
trait Delegable
{
    /**
     * @param  string  $method
     * @param  array<array-key, mixed>  $arguments
     */
    public function __call($method, $arguments): static
    {
        Delegator::create($this)->delegate($method, $arguments);

        return $this;
    }
}
