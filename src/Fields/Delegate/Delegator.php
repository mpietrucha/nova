<?php

namespace Mpietrucha\Nova\Fields\Delegate;

use Mpietrucha\Nova\Concerns\InteractsWithReflection;
use Mpietrucha\Nova\Contracts\InteractsWithReflectionInterface;
use Mpietrucha\Nova\Fields\Delegate\Contracts\ThrowableDelegateInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;

class Delegator implements CreatableInterface, InteractsWithReflectionInterface
{
    use Creatable, Forwardable, InteractsWithReflection;

    public function throwable(): bool
    {
        return $this->field() instanceof ThrowableDelegateInterface;
    }

    /**
     * @param  array<array-key, mixed>  $arguments
     */
    public function delegate(string $method, array $arguments): void
    {
        $forward = $this->field() |> $this->forward(...);

        match (true) {
            $this->throwable() => $forward->eval($method, $arguments),
            $this->unthrowable() => $forward->attempt($method, $arguments)
        };
    }
}
