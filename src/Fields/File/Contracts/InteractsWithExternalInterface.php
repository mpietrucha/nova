<?php

namespace Mpietrucha\Nova\Fields\File\Contracts;

use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;

interface InteractsWithExternalInterface extends InteractsWithRequestInterface
{
    public function external(): static;
}
