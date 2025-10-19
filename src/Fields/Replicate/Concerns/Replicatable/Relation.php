<?php

namespace Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

/**
 * phpstan-require-extends \Laravel\Nova\Fields\BelongsTo|\Laravel\Nova\Fields\BelongsToMany|\Laravel\Nova\Fields\HasMany
 */
trait Relation
{
    use Cloneable\Relation, Replicatable;

    /**
     * @var array<string, string>
     */
    protected static array $replicatable = [
        'searchable' => 'searchable',
        'displaysWithTrashed' => 'displaysWithTrashed',
        'showCreateRelationButtonCallback' => 'showCreateRelationButton',
    ];
}
