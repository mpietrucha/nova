<?php

namespace Mpietrucha\Nova\Fields;

use App\Nova\Concerns\Guessable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

/**
 * @implements \Mpietrucha\Utility\Contracts\ArrayableInterface<int, \Laravel\Nova\Fields\Field>
 */
class BelongsToMany extends \Laravel\Nova\Fields\BelongsToMany implements ArrayableInterface
{
    use Arrayable, Guessable;

    protected mixed $configurator = null;

    public function configure(callable $configurator): static
    {
        $this->configurator = $configurator;

        return $this;
    }

    public function taggable(): bool
    {
        if ($this->request()->isInlineCreateRequest()) {
            return false;
        }

        if ($this->request()->boolean('relatable')) {
            return false;
        }

        return true;
    }

    final public function untaggable(): bool
    {
        return $this->taggable() |> Normalizer::not(...);
    }

    public function toArray(): array
    {
        $fields = $this |> Arr::overlap(...);

        if ($this->taggable()) {
            return Arr::prepend($fields, $this->tag());
        }

        return $fields;
    }

    public function tag(): Tag
    {
        return $this->configurator() |> Tag::replicate($this)->withPreview()
            ->displayAsList()
            ->onlyOnForms()
            ->tap(...);
    }

    protected function request(): NovaRequest
    {
        return app(NovaRequest::class);
    }

    protected function configurator(): callable
    {
        return $this->configurator ?? Value::identity();
    }
}
