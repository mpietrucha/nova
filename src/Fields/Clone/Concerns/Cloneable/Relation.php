<?php

namespace Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;

use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;

/**
 * phpstan-require-extends \Laravel\Nova\Fields\BelongsTo|\Laravel\Nova\Fields\BelongsToMany|\Laravel\Nova\Fields\HasMany
 */
trait Relation
{
    use Cloneable;

    /**
     * @var array<int, string>
     */
    protected static array $cloneable = [
        'resourceClass',
    ];
}
