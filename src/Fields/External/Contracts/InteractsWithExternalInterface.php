<?php

namespace Mpietrucha\Nova\Fields\External\Contracts;

use Mpietrucha\Nova\Fields\Contracts\InteractsWithRequestInterface;
use Mpietrucha\Nova\Fields\External\File;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\Audio|\Laravel\Nova\Fields\Avatar|\Laravel\Nova\Fields\File|\Laravel\Nova\Fields\Image
 */
interface InteractsWithExternalInterface extends InteractsWithRequestInterface
{
    public function external(): File|static;
}
