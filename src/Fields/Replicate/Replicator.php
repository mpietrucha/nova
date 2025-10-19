<?php

namespace Mpietrucha\Nova\Fields\Replicate;

use Closure;
use Mpietrucha\Nova\Fields\Clone\Concerns\InteractsWithReflection;
use Mpietrucha\Nova\Fields\Clone\Contracts\InteractsWithReflectionInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Replicator implements CreatableInterface, InteractsWithReflectionInterface
{
    use Creatable, InteractsWithReflection;

    public function supported(string $method): bool
    {
        return $this->reflection()->hasMethod($method);
    }

    public function call(mixed $value, string $method): void
    {
        if ($this->unsupported($method)) {
            return;
        }

        $this->closure($method)->call($this->field(), $value);
    }

    protected function closure(string $method): Closure
    {
        return $this->reflection()->getMethod($method)->getClosure();
    }
}
