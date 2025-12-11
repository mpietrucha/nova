<?php

namespace Mpietrucha\Nova\Cards\Filterable;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Laravel\Filterable\Contracts\QueryInterface;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Validator implements CompatibleInterface, CreatableInterface
{
    use Compatible, Creatable;

    public function __invoke(Request $request, QueryInterface $query): bool
    {
        if (static::incompatible($request)) {
            return false;
        }

        $model = $query->getModel();

        return $request->model() instanceof $model;
    }

    /**
     * @phpstan-assert-if-true \Laravel\Nova\Http\Requests\NovaRequest $request
     */
    protected static function compatibility(Request $request): bool
    {
        return $request instanceof NovaRequest;
    }
}
