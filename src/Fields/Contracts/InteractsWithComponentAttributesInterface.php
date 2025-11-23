<?php

namespace Mpietrucha\Nova\Fields\Contracts;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\Field
 */
interface InteractsWithComponentAttributesInterface
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function withComponentAttributes(array $attributes): static;

    public function withComponentAttribute(string $attribute, mixed $value): static;
}
