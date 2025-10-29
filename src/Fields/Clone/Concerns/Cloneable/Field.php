<?php

namespace Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;

use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;

/**
 * phpstan-require-extends \Laravel\Nova\Fields\Text
 */
trait Field
{
    use Cloneable;

    /**
     * @var array<int, string>
     */
    protected static array $cloneable = [
        'resolveCallback',
    ];
}
