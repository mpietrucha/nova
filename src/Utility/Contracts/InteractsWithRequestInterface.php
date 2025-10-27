<?php

namespace Mpietrucha\Nova\Utility\Contracts;

use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\Field
 */
interface InteractsWithRequestInterface
{
    public static function request(): NovaRequest;
}
