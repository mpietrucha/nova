<?php

namespace Mpietrucha\Nova\Replicate\Concerns\Replicatable;

use Mpietrucha\Nova\Concerns\Replicatable;

trait Relations
{
    use Replicatable;

    /**
     * @var array<string, string>
     */
    protected static array $replicatable = [
        'searchable' => 'searchable',
        'displaysWithTrashed' => 'displaysWithTrashed',
        'showCreateRelationButtonCallback' => 'showCreateRelationButton',
    ];
}
