<?php

namespace Mpietrucha\Nova\Fields\Contracts;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\Field
 */
interface InteractsWithIndicatorInterface
{
    public function indicate(): static;

    public function indicator(string $indicator): static;
}
