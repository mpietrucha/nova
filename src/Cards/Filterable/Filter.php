<?php

namespace Mpietrucha\Nova\Cards\Filterable;

use Laravel\Nova\Makeable;

/**
 * @method static static make(string $name, ?string $attribute = null, mixed $handler = null, ?string $dependant = null)
 */
class Filter extends \Mpietrucha\Laravel\Filterable\Filter
{
    use Makeable;
}
