<?php

namespace Mpietrucha\Nova\Concerns;

use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Contracts\InteractsWithRequestInterface
 */
trait InteractsWithRequest
{
    public static function request(): NovaRequest
    {
        return app(NovaRequest::class);
    }
}
