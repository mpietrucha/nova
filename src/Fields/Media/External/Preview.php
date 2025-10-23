<?php

namespace Mpietrucha\Nova\Fields\Media\External;

class Preview extends Property
{
    public function get(): string
    {
        return $this->field()->value;
    }
}
