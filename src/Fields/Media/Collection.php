<?php

namespace Mpietrucha\Nova\Fields\Media;

use Laravel\Nova\Fields\Repeater;
use Mpietrucha\Utility\Arr;

class Collection extends Repeater
{
    /**
     * @param  list<\Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface>  $fields
     */
    public function __construct(string $name, array $fields)
    {
        parent::__construct($name);

        Repeatable::use($fields[0]);

        Repeatable::make() |> Arr::overlap(...) |> $this->repeatables(...);
    }
}
