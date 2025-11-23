<?php

namespace Mpietrucha\Nova\Fields\Concerns;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;

/**
 * @phpstan-require-implements \Mpietrucha\Nova\Fields\Contracts\InteractsWithComponentAttributesInterface
 */
trait InteractsWithComponentAttributes
{
    public function withComponentAttributes(array $attributes): static
    {
        $this->withComponentAttribute(...) |> Collection::make($attributes)->each(...);

        return $this;
    }

    public function withComponentAttribute(string $attribute, mixed $value): static
    {
        $attributes = Arr::get($this->meta(), $key = 'extraComponentAttributes');

        Arr::set($attributes, $attribute, $value);

        return [$key => $attributes] |> $this->withMeta(...);
    }
}
