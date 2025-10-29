<?php

namespace Mpietrucha\Nova\Fields\Media\Contracts;

use Mpietrucha\Nova\Fields\Clone\Contracts\CloneableInterface;

/**
 * @phpstan-require-extends \Laravel\Nova\Fields\Audio|\Laravel\Nova\Fields\File|\Laravel\Nova\Fields\Image
 */
interface InteractsWithMediaInterface extends CloneableInterface
{
}
