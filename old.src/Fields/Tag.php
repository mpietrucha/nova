<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Concerns\Cloneable;
use Mpietrucha\Nova\Concerns\Guessable;
use Laravel\Nova\Fields\Tag as Adapter;

class Tag extends Adapter
{
    use Replicatable\Relations, Guessable;

    protected static $replicate = [
        'searchable' => 'preload'
    ];
}
