<?php

namespace Mpietrucha\Nova\Clone\Concerns\Cloneable;

use Mpietrucha\Nova\Clone\Concerns\Cloneable;

trait Relations
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
