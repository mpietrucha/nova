<?php

namespace Mpietrucha\Nova\Replicate\Contracts;

use Laravel\Nova\Fields\Field;

interface ReplicatableInterface extends CloneableInterface
{
    public static function replicate(Field $source): static;
}
