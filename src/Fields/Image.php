<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\External\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\External\Contracts\InteractsWithExternalInterface;

class Image extends \Laravel\Nova\Fields\Image implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
