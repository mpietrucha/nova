<?php

namespace Mpietrucha\Nova\Fields\File\Contracts;

use Laravel\Nova\Fields\Field;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;

interface InteractsWithExternalInterface extends InteractsWithRequestInterface
{
    public function external(): Field;
}
