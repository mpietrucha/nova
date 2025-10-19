<?php

namespace Mpietrucha\Nova\Fields\File\Contracts;

use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\File\External;

interface InteractsWithExternalInterface extends InteractsWithRequestInterface
{
    public function external(): External|static;
}
