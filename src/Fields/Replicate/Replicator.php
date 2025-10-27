<?php

namespace Mpietrucha\Nova\Fields\Replicate;

use Closure;
use Mpietrucha\Nova\Fields\Replicate\Contracts\ThrowableReplicateInterface;
use Mpietrucha\Nova\Utility\Concerns\InteractsWithReflection;
use Mpietrucha\Nova\Utility\Contracts\InteractsWithReflectionInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Value;

class Replicator implements CreatableInterface, InteractsWithReflectionInterface
{
    use Creatable, InteractsWithReflection;

    public function throwable(): bool
    {
        return $this->field() instanceof ThrowableReplicateInterface;
    }

    public function supported(string $method): bool
    {
        return $this->reflection()->hasMethod($method);
    }

    public function call(mixed $value, string $method): void
    {
        if ($this->unsupported($method)) {
            return;
        }

        $closure = $this->closure($method);

        $attempt = Value::attempt($closure)->get($value);

        $attempt->failed() && $this->throwable() && $attempt->throwable()->throw();
    }

    protected function closure(string $method): Closure
    {
        return $this->field() |> $this->reflection()->getMethod($method)->getClosure(...);
    }
}
