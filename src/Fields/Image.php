<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\File\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\File\Contracts\InteractsWithExternalInterface;

class Image extends \Laravel\Nova\Fields\Image implements InteractsWithExternalInterface
{
    use InteractsWithExternal;
}
