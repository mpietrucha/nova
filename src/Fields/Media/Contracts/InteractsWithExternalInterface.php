<?php

namespace Mpietrucha\Nova\Fields\Media\Contracts;

use Mpietrucha\Nova\Fields\Media\External;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\File
 */
interface InteractsWithExternalInterface
{
    public function external(): External|static;
}
