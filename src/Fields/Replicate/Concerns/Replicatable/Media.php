<?php

namespace Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

use Mpietrucha\Nova\Fields\Clone\Concerns\Cloneable;
use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;

/**
 * phpstan-require-extends \Mpietrucha\Nova\Fields\File
 */
trait Media
{
    use Cloneable\Media, Replicatable;

    /**
     * @var array<string, string>
     */
    protected static array $replicatable = [
        'downloadsAreEnabled' => 'enableDownload',
    ];
}
