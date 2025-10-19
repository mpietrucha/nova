<?php

namespace Mpietrucha\Nova\Fields\Concerns;

use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * phpstan-require-implements \Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface
 */
trait InteractsWithRequest
{
    public static function request(): NovaRequest
    {
        return app(NovaRequest::class);
    }
}
