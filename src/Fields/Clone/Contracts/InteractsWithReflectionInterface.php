<?php

namespace Mpietrucha\Nova\Fields\Clone\Contracts;

use Mpietrucha\Utility\Reflection;

/**
 * @internal
 */
interface InteractsWithReflectionInterface
{
    /**
     * @return \Mpietrucha\Utility\Reflection<\Laravel\Nova\Fields\Field>
     */
    public function reflection(): Reflection;

    public function name(): string;

    public function supported(string $value): bool;

    public function unsupported(string $value): bool;
}
