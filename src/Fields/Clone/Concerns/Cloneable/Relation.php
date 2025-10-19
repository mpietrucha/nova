<?php

namespace Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;

use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;

trait Relation
{
    use Cloneable;

    /**
     * @var array<int, string>
     */
    protected static array $cloneable = [
        'attribute',
        'resourceClass',
    ];
}
