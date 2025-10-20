<?php

namespace Mpietrucha\Nova\Fields\External\Contracts;

use Laravel\Nova\Fields\Field;

/**
 * @internal
 */
interface PropertyInterface
{
    public function __invoke(): string;

    public function field(): Field;
}
