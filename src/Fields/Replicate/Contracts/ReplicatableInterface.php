<?php

namespace Mpietrucha\Nova\Fields\Replicate\Contracts;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Clone\Contracts\CloneableInterface;

interface ReplicatableInterface extends CloneableInterface
{
    public static function replicate(Field $source): static;
}
