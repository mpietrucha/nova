<?php

namespace Mpietrucha\Nova\Fields\Repeatable;

use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Concerns\InteractsWithIndicator;
use Mpietrucha\Nova\Contracts\InteractsWithIndicatorInterface;
use Mpietrucha\Nova\Fields\Repeatable\Contracts\TransformerInterface;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;

class Repeater extends \Laravel\Nova\Fields\Repeater implements InteractsWithIndicatorInterface
{
    use InteractsWithIndicator;

    public function __construct(protected TransformerInterface $transformer, string $name, ?string $attribute = null)
    {
        parent::__construct($name, $attribute);

        $this->indicate();
    }

    public function repeatables(array|Repeatable $repeatables): static
    {
        return Arr::wrap($repeatables) |> parent::repeatables(...);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    protected function resolveAttribute(mixed $model, string $attribute): mixed
    {
        $attribute = $this->transformer()->hydrate($model, $attribute);

        return parent::resolveAttribute($model, $attribute);
    }

    protected function fillAttribute(NovaRequest $request, string $requestAttribute, object $model, string $attribute): void
    {
        $input = $request->all($requestAttribute) |> Arr::first(...) |> Normalizer::array(...);

        $this->transformer()->fill($model, $attribute, $input);
    }

    protected function transformer(): TransformerInterface
    {
        return $this->transformer;
    }
}
