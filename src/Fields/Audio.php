<?php

namespace Mpietrucha\Nova\Fields;

use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithExternal;
use Mpietrucha\Nova\Fields\Media\Concerns\InteractsWithMedia;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithExternalInterface;
use Mpietrucha\Nova\Fields\Media\Contracts\InteractsWithMediaInterface;

class Audio extends \Laravel\Nova\Fields\Audio implements InteractsWithExternalInterface, InteractsWithMediaInterface
{
    use InteractsWithExternal, InteractsWithMedia;
}
