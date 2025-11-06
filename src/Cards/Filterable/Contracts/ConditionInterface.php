<?php

namespace Mpietrucha\Nova\Cards\Filterable\Contracts;

use JsonSerializable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface ConditionInterface extends InteractsWithInputInterface, JsonSerializable
{
    public function name(): string;

    public function attribute(): string;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Nova\Cards\Filterable\Contracts\FilterInterface>
     */
    public function filters(): EnumerableInterface;

    /**
     * @return array{name: string, attribute: string, filters: array<array{name: string, value: string}>}
     */
    public function jsonSerialize(): array;
}
