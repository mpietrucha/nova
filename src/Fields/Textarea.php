<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Replicate\Concerns\Replicatable;
use Mpietrucha\Nova\Fields\Replicate\Contracts\ReplicatableInterface;

class Textarea extends \Laravel\Nova\Fields\Textarea implements ReplicatableInterface
{
    use Replicatable\Field;
}
