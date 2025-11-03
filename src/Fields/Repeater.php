<?php

namespace Mpietrucha\Nova\Fields;

use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Nova\Fields\Concerns\InteractsWithIndicator;
use Mpietrucha\Nova\Fields\Contracts\InteractsWithIndicatorInterface;
use Mpietrucha\Nova\Fields\Repeater\Contracts\TransformerInterface;
use Mpietrucha\Nova\Fields\Repeater\Exception\RepeaterNameException;
use Mpietrucha\Nova\Fields\Repeater\Name;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;

class Repeater extends \Laravel\Nova\Fields\Repeater implements InteractsWithIndicatorInterface
{
    use InteractsWithIndicator;

    public function __construct(protected TransformerInterface $transformer, string $name, ?string $attribute = null)
    {
        parent::__construct($name, $attribute);

        $this->indicate();

        Name::forbidden($this) && RepeaterNameException::for($name)->throw();
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
        $attribute = $this->transformer()->hydrate($this, $model, $attribute);

        return parent::resolveAttribute($model, $attribute);
    }

    protected function fillAttribute(NovaRequest $request, string $key, object $model, string $attribute): void
    {
        $input = $request->all($key) |> Arr::first(...) |> Normalizer::array(...);

        $this->transformer()->fill($this, $model, $attribute, $input);
    }

    protected function transformer(): TransformerInterface
    {
        return $this->transformer;
    }
}
