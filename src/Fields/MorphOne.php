<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Resource\Concerns\Guessable;

class MorphOne extends \Laravel\Nova\Fields\MorphOne
{
    use Guessable;
}
