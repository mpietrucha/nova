<?php

namespace Mpietrucha\Nova\Cards\Filterable;

use Laravel\Nova\Makeable;

/**
 * @method static static make(string $name, ?string $attribute = null, mixed $filters = null)
 */
class Condition extends \Mpietrucha\Laravel\Filterable\Condition
{
    use Makeable;
}
