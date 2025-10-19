<?php

namespace Mpietrucha\Nova\Fields\Concerns;

use Mpietrucha\Utility\Concerns\Creatable;

trait Fieldable
{
    use Creatable;

    public static function make(string $name, mixed ...$arguments): static
    {
        return static::create($name, ...$arguments);
    }
}
