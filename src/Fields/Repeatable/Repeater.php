<?php

namespace Mpietrucha\Nova\Fields\Repeatable;

use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Repeatable\Contracts\TransformerInterface;
use Mpietrucha\Utility\Arr;

class Repeater extends \Laravel\Nova\Fields\Repeater
{
    public function __construct(protected TransformerInterface $transformer, string $name, ?string $attribute = null)
    {
        parent::__construct($name, $attribute);
    }

    public function repeatables(array|Repeatable $repeatables): static
    {
        return Arr::wrap($repeatables) |> parent::repeatables(...);
    }

    protected function resolveAttribute(mixed $model, string $attribute): mixed
    {
        $attribute = $this->transformer()->hydrate($model, $attribute);

        return parent::resolveAttribute($model, $attribute);
    }

    protected function fillAttribute(NovaRequest $request, string $requestAttribute, object $model, string $attribute): void
    {
        $translations = $request->get($requestAttribute);

        $this->transformer()->fill($model, $attribute, $translations);
    }

    protected function transformer(): TransformerInterface
    {
        return $this->transformer;
    }
}
