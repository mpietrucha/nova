<?php

namespace Mpietrucha\Nova\Cards\Filterable\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @phpstan-require-extends \Laravel\Nova\Card
 */
interface FilterableInterface extends InteractsWithInputInterface
{
    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Nova\Cards\Filterable\Contracts\ConditionInterface>
     */
    public function conditions(): EnumerableInterface;
}
