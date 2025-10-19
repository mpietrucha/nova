<?php

namespace Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

trait Field
{
    use Cloneable\Field, Replicatable;

    /**
     * @var array<string, string>
     */
    protected static array $replicatable = [];
}
