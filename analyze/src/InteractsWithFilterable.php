<?php

namespace Mpietrucha\Analyze;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 *
 * @extends \Laravel\Nova\Resource<TModel>
 */
abstract class InteractsWithFilterable extends \Laravel\Nova\Resource
{
    use \Mpietrucha\Nova\Cards\Filterable\Concerns\InteractsWithFilterable;
}
