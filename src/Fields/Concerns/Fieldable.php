<?php

namespace Mpietrucha\Nova\Fields\Concerns;

use Mpietrucha\Utility\Concerns\Creatable;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\Contracts\FieldableInterface
 */
trait Fieldable
{
    use Creatable;

    public static function make(mixed ...$arguments): static
    {
        return static::create(...$arguments);
    }
}
