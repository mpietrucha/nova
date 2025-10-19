<?php

namespace Mpietrucha\Nova\Fields\Concerns;

use Laravel\Nova\Http\Requests\NovaRequest;

trait InteractsWithRequest
{
    public static function request(): NovaRequest
    {
        return app(NovaRequest::class);
    }
}
