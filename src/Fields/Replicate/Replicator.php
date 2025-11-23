<?php

namespace Mpietrucha\Nova\Fields\Replicate;

use Mpietrucha\Nova\Fields\Delegate\Delegator;
use Mpietrucha\Nova\Fields\Replicate\Contracts\ThrowableReplicateInterface;
use Mpietrucha\Utility\Arr;

class Replicator extends Delegator
{
    public function throwable(): bool
    {
        return $this->field() instanceof ThrowableReplicateInterface;
    }

    public function replicate(mixed $value, string $method): void
    {
        $this->delegate($method, Arr::overlap($value));
    }
}
