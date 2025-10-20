<?php

namespace Mpietrucha\Nova\Fields\External\Property;

use Mpietrucha\Nova\Fields\External\Property;

class Preview extends Property
{
    public function get(): string
    {
        return $this->field()->value;
    }
}
