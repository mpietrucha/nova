<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithMedia;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithExternalInterface;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;

class Image extends \Laravel\Nova\Fields\Image implements InteractsWithExternalInterface, InteractsWithMediaInterface
{
    use InteractsWithExternal, InteractsWithMedia;
}
