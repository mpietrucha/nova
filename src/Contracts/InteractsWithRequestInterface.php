<?php

namespace Mpietrucha\Nova\Contracts;

use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @internal
 */
interface InteractsWithRequestInterface
{
    public static function request(): NovaRequest;
}
