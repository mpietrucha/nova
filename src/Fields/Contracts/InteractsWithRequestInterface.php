<?php

namespace Mpietrucha\Nova\Fields\Contracts;

use Laravel\Nova\Http\Requests\NovaRequest;

interface InteractsWithRequestInterface
{
    public static function request(): NovaRequest;
}
