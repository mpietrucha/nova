<?php

namespace Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

/**
 * phpstan-require-extends \Laravel\Nova\Fields\Text
 */
trait Field
{
    use Cloneable\Field, Replicatable;
}
