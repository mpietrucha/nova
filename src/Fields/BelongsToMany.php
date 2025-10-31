<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Resource\Concerns\Guessable;

class BelongsToMany extends \Laravel\Nova\Fields\BelongsToMany
{
    use Guessable;
}
