<?php

namespace Mpietrucha\Nova\Fields\Concerns;

use Laravel\Nova\Makeable;
use Mpietrucha\Utility\Concerns\Creatable;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\Contracts\FieldableInterface
 */
trait Fieldable
{
    use Creatable, Makeable;
}
