<?php

namespace Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

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
