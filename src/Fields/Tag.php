<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Concerns\Replicatable;
use Mpietrucha\Nova\Contracts\ReplicatableInterface;

class Tag extends \Laravel\Nova\Fields\Tag implements ReplicatableInterface
{
    use Replicatable\Relations;

    protected static $replicate = [
        'searchable' => 'preload'
    ];
}
