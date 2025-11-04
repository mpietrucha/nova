<?php

namespace Mpietrucha\Nova;

use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Resources\Flattener;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 *
 * @extends \Laravel\Nova\Resource<TModel>
 */
abstract class Resource extends \Laravel\Nova\Resource
{
    public function availableFields(NovaRequest $request): FieldCollection
    {
        return parent::availableFields($request) |> Flattener::flatten(...);
    }

    /**
     * @param  list<string>  $methods
     */
    public function buildAvailableFields(NovaRequest $request, array $methods): FieldCollection
    {
        return parent::buildAvailableFields($request, $methods) |> Flattener::flatten(...);
    }
}
