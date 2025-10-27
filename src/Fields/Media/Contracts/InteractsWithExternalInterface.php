<?php

namespace Mpietrucha\Nova\Fields\Media\Contracts;

use Mpietrucha\Nova\Fields\Media\External;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\Audio|\Laravel\Nova\Fields\Avatar|\Laravel\Nova\Fields\File|\Laravel\Nova\Fields\Image
 */
interface InteractsWithExternalInterface
{
    public function external(): External|static;
}
