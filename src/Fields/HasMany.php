<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Resources\Concerns\Guessable;

class HasMany extends \Laravel\Nova\Fields\HasMany
{
    use Guessable;
}
