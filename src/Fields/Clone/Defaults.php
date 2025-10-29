<?php

namespace Mpietrucha\Nova\Fields\Clone;

abstract class Defaults
{
    /**
     * @return list<string>
     */
    public static function get(): array
    {
        return [
            'name',
            'attribute',
        ];
    }
}
