<?php

namespace Mpietrucha\Nova\Fields\Contracts;

use Mpietrucha\Utility\Contracts\CreatableInterface;

interface FieldableInterface extends CreatableInterface
{
    public static function make(mixed ...$arguments): static;
}
