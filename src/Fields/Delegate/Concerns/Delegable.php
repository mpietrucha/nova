<?php

namespace Mpietrucha\Nova\Fields\Delegate\Concerns;

use Mpietrucha\Nova\Fields\Delegate\Delegator;

/**
 * @mixin \Laravel\Nova\Fields\Field
 *
 * @phpstan-require-extends \Laravel\Nova\Fields\Field
 *
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
trait Delegable
{
    /**
     * @param  string  $method
     * @param  MixedArray  $arguments
     */
    public function __call($method, $arguments): static
    {
        Delegator::create($this)->delegate($method, $arguments);

        return $this;
    }
}
