<?php

namespace App\Nova\Contracts;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface CloneableInterface
{
    public static function clone(Field $field): static;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public static function cloneable(Field $field): EnumerableInterface;
}
