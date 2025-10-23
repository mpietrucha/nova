<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Resource\Concerns\Guessable;

class BelongsTo extends \Laravel\Nova\Fields\BelongsTo
{
    use Guessable;
}
