<?php

namespace Mpietrucha\Nova\Clone\Contracts;

use Laravel\Nova\Fields\Field;

interface CloneableInterface
{
    public static function clone(Field $source): static;
}
