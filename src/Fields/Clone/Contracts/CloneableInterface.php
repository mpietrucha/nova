<?php

namespace Mpietrucha\Nova\Fields\Clone\Contracts;

use Laravel\Nova\Fields\Field;

interface CloneableInterface
{
    public static function clone(Field $source): static;
}
