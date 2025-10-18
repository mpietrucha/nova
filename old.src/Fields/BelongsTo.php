<?php

namespace Mpietrucha\Nova\Fields;

use App\Nova\Concerns\Guessable;

class BelongsTo extends \Laravel\Nova\Fields\BelongsTo
{
    use Guessable;
}
