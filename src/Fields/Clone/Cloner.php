<?php

namespace Mpietrucha\Nova\Fields\Clone;

use Mpietrucha\Nova\Fields\Clone\Concerns\InteractsWithReflection;
use Mpietrucha\Nova\Fields\Clone\Contracts\InteractsWithReflectionInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Cloner implements CreatableInterface, InteractsWithReflectionInterface
{
    use Creatable, InteractsWithReflection;

    public function supported(string $property): bool
    {
        return $this->reflection()->hasProperty($property);
    }

    public function get(string $property): mixed
    {
        if ($this->unsupported($property)) {
            return null;
        }

        return $this->field() |> $this->reflection()->getProperty($property)->getValue(...);
    }
}
