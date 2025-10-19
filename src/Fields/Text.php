<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;
use Mpietrucha\Nova\Fields\Replicate\Contracts\ReplicatableInterface;

class Text extends \Laravel\Nova\Fields\Text implements ReplicatableInterface
{
    use Replicatable\Field;
}
