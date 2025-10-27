<?php

namespace Mpietrucha\Nova\Utility\Contracts;

/**
 * @internal
 */
interface InteractsWithThrowableInterface
{
    /**
     * @phpstan-assert-if-true false $this->unthrowable()
     *
     * @phpstan-assert-if-false true $this->unthrowable()
     */
    public function throwable(): bool;

    /**
     * @phpstan-assert-if-true false $this->throwable()
     *
     * @phpstan-assert-if-false true $this->throwable()
     */
    public function unthrowable(): bool;
}
