<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Resource\Concerns\Guessable;

class HasMany extends \Laravel\Nova\Fields\HasMany
{
    use Guessable;
}
