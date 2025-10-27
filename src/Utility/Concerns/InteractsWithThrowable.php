<?php

namespace Mpietrucha\Nova\Utility\Concerns;

use Mpietrucha\Utility\Normalizer;

/**
 * @phpstan-require-implements \Mpietrucha\Nova\Utility\Contracts\InteractsWithThrowableInterface
 */
trait InteractsWithThrowable
{
    public function throwable(): bool
    {
        return false;
    }

    final public function unthrowable(): bool
    {
        return $this->throwable() |> Normalizer::not(...);
    }
}
