<?php

namespace Mpietrucha\Nova\Cards\Filterable\Concerns;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Cards\Filterable;

/**
 * @phpstan-require-extends \Laravel\Nova\Resource
 */
trait InteractsWithFilterable
{
    public static function indexQuery(NovaRequest $request, Builder $query): Builder
    {
        return Filterable::query($query)->apply($request);
    }
}
