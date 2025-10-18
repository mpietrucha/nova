<?php

namespace Mpietrucha\Nova;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Nova\Contracts\FrontendInterface;

abstract class Frontend implements FrontendInterface
{
    use Creatable;
}
