<?php

namespace App\Nova\Concerns;

use Mpietrucha\Utility\Concerns\Creatable;

trait Fieldable
{
    use Creatable;

    public static function make(string $name, mixed ...$parameters): static
    {
        return static::create($name, ...$parameters);
    }
}
