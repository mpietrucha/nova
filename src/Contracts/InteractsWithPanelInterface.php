<?php

namespace Mpietrucha\Nova\Contracts;

/**
 * @phpstan-require-extends \Laravel\Nova\Panel
 */
interface InteractsWithPanelInterface
{
    public static function name(): string;

    /**
     * @return list<\Laravel\Nova\Fields\Field>
     */
    public static function fields(): array;
}
