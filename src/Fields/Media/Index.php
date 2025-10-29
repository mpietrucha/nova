<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Fields\Hidden;

class Index extends Hidden
{
    public function __construct()
    {
        static::property() |> parent::__construct(...);
    }

    final public static function property(): string
    {
        return 'index';
    }
}
