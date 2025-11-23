<?php

namespace Mpietrucha\Nova\Fields\Delegate;

use Mpietrucha\Nova\Fields\Concerns\InteractsWithReflection;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithReflectionInterface;
use Mpietrucha\Nova\Fields\Delegate\Contracts\ThrowableDelegateInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
class Delegator implements CreatableInterface, InteractsWithReflectionInterface
{
    use Creatable, Forwardable, InteractsWithReflection;

    public function throwable(): bool
    {
        return $this->field() instanceof ThrowableDelegateInterface;
    }

    public function supported(string $method): bool
    {
        return $this->reflection()->hasMethod($method);
    }

    /**
     * @param  MixedArray  $arguments
     */
    public function delegate(string $method, array $arguments): void
    {
        if ($this->unsupported($method)) {
            return;
        }

        $forward = $this->field() |> $this->forward(...);

        match (true) {
            $this->throwable() => $forward->eval($method, $arguments),
            $this->unthrowable() => $forward->attempt($method, $arguments)
        };
    }
}
